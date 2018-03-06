<?php

namespace App\Command;

use App\Translations\Catalogue\BaiduTranslateOperation;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Translation\Catalogue\MergeOperation;
use Symfony\Component\Translation\Catalogue\TargetOperation;
use Symfony\Component\Translation\Extractor\ExtractorInterface;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Reader\TranslationReaderInterface;
use Symfony\Component\Translation\Writer\TranslationWriterInterface;
use Symfony\Component\Translation\Translator;

class TransGenerateCommand extends BaseCommand
{
    protected static $defaultName = 'trans:generate';

    private $writer;
    private $reader;
    private $extractor;
    private $defaultLocale;

    /**
     * TransGenerateCommand constructor.
     * @param null $writer
     * @param TranslationReaderInterface|null $reader
     * @param ExtractorInterface|null $extractor
     * @param null $defaultLocale
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct($writer = null, TranslationReaderInterface $reader = null, ExtractorInterface $extractor = null, $defaultLocale = null)
    {
        if (!$writer instanceof TranslationWriterInterface) {
            @trigger_error(sprintf('%s() expects an instance of "%s" as first argument since Symfony 3.4. Not passing it is deprecated and will throw a TypeError in 4.0.', __METHOD__, TranslationWriterInterface::class), E_USER_DEPRECATED);

            parent::__construct($writer);

            return;
        }

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
            ->addOption('dump-messages', null, InputOption::VALUE_NONE, 'Should the messages be dumped in the console')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Should the update be done')
            ->addOption('baidu', null, InputOption::VALUE_NONE, 'Enable Baidu Translate')
            ->addOption('clean', null, InputOption::VALUE_NONE, 'Should clean not found messages')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> command extracts translation strings from templates
of a given bundle or the app folder. It can display them or merge the new ones into the translation files.

When new translation strings are found it can automatically add a prefix to the translation
message.

Example running against app messages (src/Resources folder)
  <info>php %command.full_name% --dump-messages en</info>
  <info>php %command.full_name% --force fr</info>
EOF
            );
    }

    /**
     * {@inheritdoc}
     *
     * BC to be removed in 4.0
     */
    public function isEnabled()
    {
        if (null !== $this->writer) {
            return parent::isEnabled();
        }
        if (!class_exists(Translator::class)) {
            return false;
        }

        return parent::isEnabled();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Symfony\Component\Translation\Exception\LogicException
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \LogicException
     */
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

        // check presence of force or dump-message
        if (true !== $input->getOption('force') && true !== $input->getOption('dump-messages')) {
            $errorIo->error('You must choose one of --force or --dump-messages');

            return 1;
        }

        $locale = $input->getArgument('locale') ?? $this->getContainer()->getParameter('locale');
        $projectDir = $this->getContainer()->getParameter('kernel.project_dir');

        $errorIo->title('Translation Messages Extractor and Dumper');
        $errorIo->comment(sprintf('Generating "<info>%s</info>" files for "app folder"', $locale));

        $controllersPath = $projectDir.'/src/Controller';
        $formPath = $projectDir.'/src/Form';
        $viewsPath = $projectDir.'/templates';

        // Define Root Paths
        $transPath = $projectDir.'/translations';

        // load any messages from templates
        $extractedCatalogue = new MessageCatalogue($locale);

        $errorIo->comment('Parsing Controllers...');
        if (is_dir($controllersPath)) {
            $this->extractor->extract($controllersPath, $extractedCatalogue);
        }

        $errorIo->comment('Parsing forms...');
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
        $clean = false;
        if ($input->getOption('clean')) {
            $clean = $input->getOption('clean');
            $operation = $input->getOption('baidu')
                ? new BaiduTranslateOperation($currentCatalogue, $extractedCatalogue, $this->getContainer(), $clean)
                : new TargetOperation($currentCatalogue, $extractedCatalogue);
        } else {
            $operation = $input->getOption('baidu')
                ? new BaiduTranslateOperation($currentCatalogue, $extractedCatalogue, $this->getContainer(), $clean)
                : new MergeOperation($currentCatalogue, $extractedCatalogue);
        }

        // Exit if no messages found.
        if (!\count($operation->getDomains())) {
            $errorIo->warning('No translation messages were found.');

            return;
        }

        $resultMessage = 'Translation files were successfully updated';

        // show compiled list of messages
        if (true === $input->getOption('dump-messages')) {
            $extractedMessagesCount = 0;
            $io->newLine();
            foreach ($operation->getDomains() as $domain) {
                $newKeys = array_keys($operation->getNewMessages($domain));
                $allKeys = array_keys($operation->getMessages($domain));

                $list = array_merge(
                    array_diff($allKeys, $newKeys),
                    array_map(function ($id) {
                        return sprintf('<fg=green>%s</>', $id);
                    }, $newKeys),
                    array_map(function ($id) {
                        return sprintf('<fg=red>%s</>', $id);
                    }, array_keys($operation->getObsoleteMessages($domain)))
                );

                $domainMessagesCount = \count($list);

                $io->section(sprintf('Messages extracted for domain "<info>%s</info>" (%d message%s)', $domain, $domainMessagesCount, $domainMessagesCount > 1 ? 's' : ''));
                $io->listing($list);

                $extractedMessagesCount += $domainMessagesCount;
            }

            $resultMessage = sprintf('%d message%s successfully extracted', $extractedMessagesCount, $extractedMessagesCount > 1 ? 's were' : ' was');
        }

        // save the files
        if (true === $input->getOption('force')) {
            $errorIo->comment('Writing files...');

            $this->writer->write($operation->getResult(), 'yml', array('path' => $transPath, 'default_locale' => $this->defaultLocale));

            if (true === $input->getOption('dump-messages')) {
                $resultMessage .= ' and translation files were updated';
            }
        }

        $errorIo->success($resultMessage.'.');
    }
}