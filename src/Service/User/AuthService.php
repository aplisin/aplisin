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
        $user->setUserProfile($userProfile);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->persist($userProfile);
        $this->getEntityManager()->flush();
        return $user;
    }
    protected function getPasswordEncoder()
    {
        return $this->container->get('security.password_encoder');
    }
}