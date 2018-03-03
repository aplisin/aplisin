<?php

namespace App\Service\User;

use App\Service\BaseService;

class UserService extends BaseService
{
    public function getUser($id)
    {
        return $this->getUserRepository()->find($id);
    }

    public function getUserByUsername($username)
    {
        return $this->getUserRepository()->findOneByUsername($username);
    }

    public function getUserByEmail($email)
    {
        return $this->getUserRepository()->findOneByEmail($email);
    }

    protected function getUserRepository()
    {
        return $this->getEntityManager()->getRepository('App:User\User');
    }
}