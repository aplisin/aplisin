<?php

namespace App\Security\User;

use App\Form\User\LoginUserType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getLoginUrl()
    {
        return $this->getRouter()->generate('login');
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() === '/login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            // skip authentication
            return null;
        }

        $csrfToken = $request->request->get('authenticate')['_token'];
        if (false === $this->getCsrfTokenManager()->isTokenValid(new CsrfToken('authenticate', $csrfToken))) {
            throw new InvalidCsrfTokenException('Invalid CSRF token.');
        }

        $form = $this->getFormFactory()->create(LoginUserType::class);
        $form->handleRequest($request);
        $data = array();
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        $request->getSession()->set(Security::LAST_USERNAME, $data['username']);

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];
        return $this->getUserService()->getUserByLoginField($username);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['password'];
        return $this->getUserPasswordEncoder()->isPasswordValid($user, $password);
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->getRouter()->generate('homepage');
    }

    protected function getCsrfTokenManager()
    {
        return $this->container->get('security.csrf.token_manager');
    }

    protected function getUserService()
    {
        return $this->container->get('service.user.user_service');
    }

    protected function getFormFactory()
    {
        return $this->container->get('form.factory');
    }

    protected function getRouter()
    {
        return $this->container->get('router');
    }

    protected function getUserPasswordEncoder()
    {
        return $this->container->get('security.password_encoder');
    }
}
