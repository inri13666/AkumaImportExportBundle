<?php

namespace Akuma\Bundle\ImportExportBundle\Registry;

use Akuma\Bundle\ImportExportBundle\Model\ImportModelInterface;

interface ImportProcessorInterface extends ProcessorInterface
{

    /**
     * Returns an array of models to import
     *
     * @param mixed $source
     *
     * @return ImportModelInterface[]
     */
    public function processSource($source);

    /**
     * Returns Entity
     *
     * @param ImportModelInterface $record
     *
     * @return mixed
     */
    public function processRecord(ImportModelInterface $record);
}
