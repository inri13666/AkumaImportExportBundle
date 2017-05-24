<?php

namespace Akuma\Bundle\ImportExportBundle\Command;

use Akuma\Bundle\ImportExportBundle\Model\ImportModelInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    const BATCH_SIZE = 100;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('akuma:import')
            ->addOption('processor', null, InputOption::VALUE_REQUIRED)
            ->addArgument('source', InputArgument::REQUIRED)
            ->addOption('dry-run', null, InputOption::VALUE_NONE);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $registry = $this->getContainer()->get('akuma.import_export.registry');
        $processor = $registry->getImportProcessor($input->getOption('processor'));
        $em = $this->getContainer()->get('doctrine')->getManager();

        /** @var ImportModelInterface[] $records */
        $toProcess = $processor->processSource($input->getArgument('source'));
        if (!count($toProcess)) {
            return 0;
        }

        $records = $toProcess;//array_splice($toProcess, 0, 100);

        $headers = reset($records)->getFields();
        if ($input->getOption('dry-run')) {
            $table = new Table($output);
            $table->setHeaders($headers)->setRows([]);
            foreach ($records as $record) {
                $table->addRow($record->toArray());
            }
            $table->render();

            return 0;
        }

        $count = count($records);
        $output->writeln(sprintf('Found %d records to import', $count));
        $i = 0;
        foreach ($records as $record) {
            $entity = $processor->processRecord($record);

            if ($entity) {
                $em->persist($entity);
            }

            if ($i >= self::BATCH_SIZE) {
                $count -= self::BATCH_SIZE;
                $output->writeln(sprintf('Flushing %d records, to process %d', self::BATCH_SIZE, $count));
                $em->flush();
                $i = 0;
            }
            $i++;
        }

        $em->flush();
    }

}
