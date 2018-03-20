<?php

namespace App\Security\User;

use App\Form\User\LoginUserType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
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

    /**
     * Return the URL to the login page.
     *
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->getRouter()->generate('login');
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return array(
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      );
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return array('api_key' => $request->headers->get('X-API-TOKEN'));
     *
     * @param Request $request
     *
     * @return mixed Any non-null value
     *
     * @throws \UnexpectedValueException If null is returned
     */
    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() === '/login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            // skip authentication
            return null;
        }

        $csrfToken = $request->request->get('authenticate')['_token'];
        $this->isTokenValid('authenticate', $csrfToken);

        $form = $this->getFormFactory()->create(LoginUserType::class);
        $form->handleRequest($request);

        $data = array();
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        $request->getSession()->set(Security::LAST_USERNAME, $data['username']);

        return $data;
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @throws AuthenticationException
     *
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];
        return $userProvider->loadUserByUsername($username);
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     * @param UserInterface $currentUser
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $currentUser)
    {
        $password = $credentials['password'];
        return $this->getPasswordEncoder()->isPasswordValid($currentUser, $password);
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->getRouter()->generate('homepage');
    }

    protected function isTokenValid($tokenId, $csrfToken)
    {
        if (false === $this->getCsrfTokenManager()->isTokenValid(new CsrfToken($tokenId, $csrfToken))) {
            throw new InvalidCsrfTokenException('Invalid CSRF token.');
        }

        return true;
    }

    protected function getRouter()
    {
        return $this->container->get('router');
    }

    protected function getCsrfTokenManager()
    {
        return $this->container->get('security.csrf.token_manager');
    }

    protected function getFormFactory()
    {
        return $this->container->get('form.factory');
    }

    protected function getPasswordEncoder()
    {
        return $this->container->get('security.password_encoder');
    }

    protected function getUserService()
    {
        return $this->container->get('app.service.user.user_service');
    }
}
