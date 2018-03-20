<?php

namespace App\Security\User;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $username
     * @return CurrentUser|UserInterface
     * @throws \Symfony\Component\Security\Core\Exception\UsernameNotFoundException
     */
    public function loadUserByUsername($username)
    {
        $currentUser = $this->getUserService()->getUserByUsername($username);

        if (!$currentUser) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return new CurrentUser($currentUser);
    }

    /**
     * @param UserInterface $currentUser
     * @return CurrentUser|UserInterface
     * @throws \Symfony\Component\Security\Core\Exception\UnsupportedUserException
     */
    public function refreshUser(UserInterface $currentUser)
    {
        if (!$currentUser instanceof CurrentUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', \get_class($currentUser))
            );
        }

        return $this->loadUserByUsername($currentUser->getUsername());
    }

    public function supportsClass($class)
    {
        return CurrentUser::class === $class;
    }

    protected function getUserService()
    {
        return $this->container->get('app.service.user.user_service');
    }
}