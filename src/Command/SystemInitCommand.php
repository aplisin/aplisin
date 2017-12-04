<?php

namespace App\Command;

use App\Entity\User\User;
use App\Entity\User\UserProfile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SystemInitCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'system:init';

    protected function configure()
    {
        $this->setDescription('Start initializing the system');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->writeln('Start initialization system');

        $fields = array(
            'username' => 'administrator',
            'email' => 'test@aplisin.com',
            'password' => 'developer',
        );

        $this->initAdminUser($fields, $io);

        $io->success('Initialization system is completed');
    }

    /**
     * @param $fields
     * @param $io SymfonyStyle
     */
    private function initAdminUser($fields, $io)
    {
        $io->writeln("Create an administrator account:{$fields['username']}, password: {$fields['password']}");

        $user = $this->getUserService()->getUserByLoginField($fields['username']);

        if (empty($user)) {
            $user = new User();
            $user
                ->setUsername($fields['username'])
                ->setEmail($fields['email'])
                ->setPassword($fields['password'])
                ->setRoles(array('ROLE_USER', 'ROLE_ADMIN'))
                ->setIsActive(true);
            $password = $this->getContainer()->get('security.password_encoder')->encodePassword($user, $fields['password']);
            $user->setPassword($password);

            $userProfile = new UserProfile();
            $userProfile->setTruename('');
            $userProfile->setUser($user);

            $em = $this->getContainer()->get('doctrine')->getManager();
            $em->persist($user);
            $em->persist($userProfile);
            $em->flush();
        }

        $io->writeln('success');
    }


    private function getUserService()
    {
        return $this->getContainer()->get('service.user.user_service');
    }
}
