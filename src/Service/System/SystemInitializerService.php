<?php

namespace App\Service\System;

use App\Entity\User\User;
use App\Service\BaseService;
use Symfony\Component\Console\Output\OutputInterface;

class SystemInitializerService extends BaseService
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function init(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param $fields
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function initAdminUser($fields)
    {
        $this->output->write("  Create an administrator account:{$fields['username']}, password: {$fields['password']}");
        $user = $this->getUserService()->getUserByUsername($fields['username']);

        if (empty($user)) {
            $user = new User();
            $user
                ->setUsername($fields['username'])
                ->setEmail($fields['email'])
                ->setPassword($fields['password'])
                ->setRoles(array('ROLE_SUPER_ADMIN'));

            $this->getAuthService()->register($user);
        }

        $this->output->writeln(' ...<info>success</info>');
    }

    protected function getAuthService()
    {
        return $this->container->get('app.service.user.auth_service');
    }

    protected function getUserService()
    {
        return $this->container->get('app.service.user.user_service');
    }
}