<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserProvider;

/**
 * Class SecurityController
 * @package App\Controller\Api
 */
class SecurityController extends BaseController
{
    public function loginCheckAction(Request $request)
    {
        $auth = $request->request->get('auth');

        $user = $this->getUserProvider()->loadUserByUsername($auth['username']);
        if (!$user) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $user->getUsername())
            );
        }

        $isValid = $this->getPasswordEncoder()->isPasswordValid($user, $auth['password']);
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