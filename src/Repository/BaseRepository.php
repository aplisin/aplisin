<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

abstract class BaseRepository extends ServiceEntityRepository
{
    protected $enityClass;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, $this->enityClass);
    }
}
