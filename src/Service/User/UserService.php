<?php

namespace App\Service\User;

use App\Entity\User\User;
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

    /**
     * @param $user User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function lockUser($user)
    {
        $user->setIsLocked(true);
        $this->getEntityManager()->flush();
    }

    /**
     * @param array $conditions
     * @param array $orderBys
     * @param null $indexBy
     * @return \Doctrine\ORM\Query
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
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