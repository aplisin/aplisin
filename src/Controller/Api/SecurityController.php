<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class SecurityController extends Controller
{
    public function loginCheckAction(Request $request)
    {
        $fields = $request->request->all();

        $user = $this->getUserProvider()->loadUserByUsername($fields['username']);

        if (!$user) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $user->getUsername())
            );
        }

        $isValid = $this->getPasswordEncoder()->isPasswordValid($user, $fields['password']);
        if (!$isValid) {
            throw new BadCredentialsException();
        }

        return $this->getAuthSuccessHandler()->handleAuthenticationSuccess($user);
    }

    protected function getUserProvider()
    {
        return $this->get('app.security.user.user_provider');
    }

    protected function getPasswordEncoder()
    {
        return $this->get('security.password_encoder');
    }

    protected function getAuthSuccessHandler()
    {
        return $this->get('lexik_jwt_authentication.handler.authentication_success');
    }
}