<?php

namespace App\Service\User;

use App\Service\BaseService;

class UserService extends BaseService
{
    public function getUserByLoginField($keyword)
    {
        return $this->getUserRepository()->findOneBy(array('username' => $keyword));
    }

    protected function getUserRepository()
    {
        return $this->getEntityManager()->getRepository('AppBundle:User\User');
    }
}