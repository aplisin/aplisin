<?php

namespace App\Service\User;

use App\Entity\User\User;
use App\Entity\User\UserProfile;
use App\Service\BaseService;

class AuthService extends BaseService
{
    /**
     * @param $user User
     * @return mixed
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function register($user)
    {
        $password = $this->getPasswordEncoder()->encodePassword($user, $user->getPassword());
        $user->setPassword($password);

        $userProfile = new UserProfile();
        $userProfile = $this->filterProfileFields($userProfile);

        $user->setUserProfile($userProfile);
        $user = $this->filterUserFields($user);

        $em = $this->getEntityManager();
        $em->persist($user);
        $em->persist($userProfile);
        $em->flush();

        return $user;
    }

    /**
     * @param $user User
     * @return mixed
     */
    private function filterUserFields($user)
    {

        if ($user->getisActive() === null) {
            $user->setIsActive(true);
        }

        if ($user->getRoles() === null) {
            $user->setRoles(array('ROLE_USER'));
        }

        return $user;
    }

    /**
     * @param $userProfile UserProfile
     * @return mixed
     */
    private function filterProfileFields($userProfile)
    {
        if ($userProfile->getTruename() === null) {
            $userProfile->setTruename('');
        }

        return $userProfile;
    }

    protected function getPasswordEncoder()
    {
        return $this->container->get('security.password_encoder');
    }
}