<?php

namespace App\Service\User;

use App\Service\BaseService;

class UserService extends BaseService
{
    /**
     * @param $username
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function getUserByUsername($username)
    {
        return $this->getUserRepository()->findOneByUsername($username);
    }

    /**
     * @param $email
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function getUserByEmail($email)
    {
        return $this->getUserRepository()->findOneByEmail($email);
    }

    protected function getUserRepository()
    {
        return $this->getEntityManager()->getRepository('App:User\User');
    }
}