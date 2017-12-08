<?php

namespace App\Service\User;

use App\Entity\User\User;
use App\Entity\User\UserProfile;
use App\Service\BaseService;

class AuthService extends BaseService
{
    /**
     * @param $user User
     * @param string $type
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function register($user, $type = 'default')
    {
        $password = $this->container->get('security.password_encoder')->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
        $user->setRoles(array('ROLE_USER', $user->getRoles()));
        $user->setIsActive(true);

        $userProfile = new UserProfile();
        $userProfile->setTruename('');
        $userProfile->setUser($user);

        $em = $this->container->get('doctrine')->getManager();
        $em->persist($user);
        $em->persist($userProfile);
        $em->flush();
    }
}