<?php

namespace App\Repository\User;

use App\Entity\User\User;
use App\Repository\BaseRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends BaseRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    protected function declares()
    {
        return array(
            'where' => array(
                'u.username LIKE :username',
                'u.email LIKE :email'
            ),
            'orderbys' => array(
                'createdAt',
                'updatedAt'
            )
        );
    }
}
