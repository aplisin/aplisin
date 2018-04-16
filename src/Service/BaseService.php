<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class BaseService implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}