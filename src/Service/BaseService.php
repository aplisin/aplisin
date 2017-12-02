<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}