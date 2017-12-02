<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use App\Form\User\LoginUserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{
    public function login(AuthenticationUtils $authenticationUtils)
    {
        if ($this->isLogin()) {
            return $this->createMessageResponse('info', '你已经登录了');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginUserType::class, array(
            'user[username]' => $lastUsername
        ));

        return $this->render('web/security/login.html.twig', array(
            'form' => $form->createView(),
            'error' => $error
        ));
    }

    public function logout()
    {
        throw new \RuntimeException('this should not be reached!');
    }

    public function loginCheck()
    {
        return new Response('login_check');
    }
}
