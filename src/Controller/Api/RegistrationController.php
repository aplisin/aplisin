<?php

namespace App\Controller\Api;

use App\Entity\User\User;
use App\Form\User\RegistrationUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationController
 * @package App\Controller\Api
 * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return null|Response
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function registerAction(Request $request): ?Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationUserType::class, $user);

        $data = $request->getContent();
        $data = json_decode($data, true);

        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getAuthService()->register($user);
            return $this->getAuthSuccessHandler()->handleAuthenticationSuccess($user);
        }

        $errors = $form->getErrors(true, true);
        $errorCollection = [];
        foreach ($errors as $error) {
            $errorCollection[$error->getOrigin()->getConfig()->getName()] = $error->getMessage();
        }

        $array = ['code' => 400, 'message' => $errorCollection];

        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    protected function getAuthService()
    {
        return $this->get('app.service.user.auth_service');
    }

    protected function getAuthGuardHandler()
    {
        return $this->get('security.authentication.guard_handler');
    }

    protected function getAuthSuccessHandler()
    {
        return $this->get('lexik_jwt_authentication.handler.authentication_success');
    }
}