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

    public function getQueryBuilder(array $conditions, array $orderBys, $indexBy = null)
    {
        $conditions = array_filter(
            $conditions,
            function ($value) {
                if ($value === '' || $value === null) {
                    return false;
                }

                if (\is_array($value) && empty($value)) {
                    return false;
                }

                return true;
            }
        );

        if (isset($conditions['keywordType'], $conditions['keyword'])) {
            $conditions[$conditions['keywordType']] = $conditions['keyword'];

            unset($conditions['keywordType'], $conditions['keyword']);
        }


        return $this->getUserRepository()->getQueryBuilder($conditions, $orderBys, 'u', $indexBy);
    }

    protected function getUserRepository()
    {
        return $this->getEntityManager()->getRepository('App:User\User');
    }
}