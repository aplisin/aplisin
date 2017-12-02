<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use App\Entity\User\User;
use App\Form\User\RegistrationUserType;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    public function register(Request $request)
    {
        if ($this->isLogin()) {
            throw $this->createAccessDeniedException($this->get('translator')->trans('You are already logged in'));
        }

        $user = new User();
        $form = $this->createForm(RegistrationUserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getAuthService()->register($user, 'default');

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('security.user.login_form_authenticator'),
                    'main'
                );
        }

        return $this->render(
            'web/registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    protected function getAuthService()
    {
        return $this->get('service.user.auth_service');
    }
}