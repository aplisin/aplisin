<?php

namespace App\Command;

use App\Translations\Catalogue\BaiduTranslateOperation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Translation\Catalogue\MergeOperation;
use Symfony\Component\Translation\Extractor\ExtractorInterface;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Reader\TranslationReaderInterface;

class TransGenerateCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'trans:generate';

    private $writer;
    private $reader;
    private $extractor;
    private $defaultLocale;

    public function __construct($writer = null, TranslationReaderInterface $reader = null, ExtractorInterface $extractor = null, $defaultLocale = null)
    {
        parent::__construct();

        $this->writer = $writer;
        $this->reader = $reader;
        $this->extractor = $extractor;
        $this->defaultLocale = $defaultLocale;
    }

    protected function configure()
    {
        $this
            ->setDescription('Updates the translation file')
            ->addArgument('locale', InputArgument::OPTIONAL, 'The locale')
            ->addOption('baidu', null, InputOption::VALUE_NONE, 'Enable Baidu Translate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // BC to be removed in 4.0
        if (null === $this->writer) {
            $this->writer = $this->getContainer()->get('translation.writer');
            $this->reader = $this->getContainer()->get('translation.reader');
            $this->extractor = $this->getContainer()->get('translation.extractor');
            $this->defaultLocale = $this->getContainer()->getParameter('kernel.default_locale');
        }

        $io = new SymfonyStyle($input, $output);
        $errorIo = $io->getErrorStyle();
        $locale = $input->getArgument('locale');
        $projectDir = $this->getContainer()->getParameter('kernel.project_dir');

        if (!$locale) {
            $locale = $this->getContainer()->getParameter('locale');
        }

        $io->writeln(sprintf('Generating "<info>%s</info>" files for "app folder"', $locale));

        $controllersPath = $projectDir . '/src/Controller';
        $formPath = $projectDir . '/src/Form';
        $viewsPath = $projectDir . '/templates';

        // Define Root Paths
        $transPath = $projectDir . '/translations';

        // load any messages from templates
        $extractedCatalogue = new MessageCatalogue($locale);

        $errorIo->comment('Parsing Controllers...');
        if (is_dir($controllersPath)) {
            $this->extractor->extract($controllersPath, $extractedCatalogue);
        }

        $errorIo->comment('Parsing froms...');
        if (is_dir($formPath)) {
            $this->extractor->extract($formPath, $extractedCatalogue);
        }

        $errorIo->comment('Parsing templates...');
        if (is_dir($viewsPath)) {
            $this->extractor->extract($viewsPath, $extractedCatalogue);
        }

        // load any existing messages from the translation files
        $currentCatalogue = new MessageCatalogue($locale);
        $errorIo->comment('Loading translation files...');
        if (is_dir($transPath)) {
            $this->reader->read($transPath, $currentCatalogue);
        }

        // process catalogues
        if (true === $input->getOption('baidu')) {
            $operation = new BaiduTranslateOperation($currentCatalogue, $extractedCatalogue, $this->getContainer());
        } else {
            $operation = new MergeOperation($currentCatalogue, $extractedCatalogue);
        }

        $resultMessage = 'Translation files were successfully updated';

        $errorIo->comment('Writing files...');

        $this->writer->write($operation->getResult(), 'yml', array('path' => $transPath, 'default_locale' => $this->defaultLocale));

        $errorIo->success($resultMessage . '.');
    }
}
