<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use App\Entity\User\User;
use App\Form\User\RegistrationUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationController
 * @package App\Controller\Web
 * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
 */
class RegistrationController extends BaseController
{
    /**
     * @param Request $request
     * @return null|Response
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function registerAction(Request $request): ?Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationUserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getAuthService()->register($user);

            return $this->getAuthGuardHandler()->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $this->getLoginFormAuthenticator(),
                'main'
            );
        }

        return $this->render('web/registration/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    protected function getAuthService()
    {
        return $this->get('app.service.user.auth_service');
    }

    protected function getAuthGuardHandler()
    {
        return $this->get('security.authentication.guard_handler');
    }

    protected function getLoginFormAuthenticator()
    {
        return $this->get('app.security.user.login_form_authenticator');
    }
}