<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SystemInitCommand extends BaseCommand
{
    protected static $defaultName = 'system:init';

    protected function configure()
    {
        $this->setDescription('Start initializing the system');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->writeln('<info>Start initialization system</info>');

        $initializer = $this->getSystemInitializerService();
        $fields = array(
            'username' => 'administrator',
            'email' => 'test@aplisin.com',
            'password' => 'developer'
        );

        $initializer->init($output);
        $initializer->initAdminUser($fields);

        $io->writeln('<info>Initialization system is completed</info>');
    }

    private function getSystemInitializerService()
    {
        return $this->getContainer()->get('app.service.system.system_initializer_service');
    }
}