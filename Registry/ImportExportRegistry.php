<?php

namespace Akuma\Bundle\ImportExportBundle\Registry;

use Akuma\Bundle\ImportExportBundle\Exception\ProcessorNotFoundException;

class ImportExportRegistry
{
    /** @var array|ImportProcessorInterface[] */
    protected $importProcessors = [];

    /** @var array|ExportProcessorInterface[] */
    protected $exportProcessors = [];

    /**
     * @param ImportProcessorInterface $processor
     * @param string $alias
     */
    public function addImportProcessor(ImportProcessorInterface $processor, $alias)
    {
        $this->importProcessors[$alias] = $processor;
    }

    /**
     * @param ExportProcessorInterface $processor
     * @param string $alias
     */
    public function addExportProcessor(ExportProcessorInterface $processor, $alias)
    {
        $this->exportProcessors[$alias] = $processor;
    }

    /**
     * @param string $alias
     *
     * @return bool
     */
    public function hasImportProcessor($alias)
    {
        return isset($this->importProcessors[$alias]);
    }

    /**
     * @param string $alias
     *
     * @return mixed|ImportProcessorInterface
     */
    public function getImportProcessor($alias)
    {
        if (!$this->hasImportProcessor($alias)) {
            throw new ProcessorNotFoundException($alias);
        }

        return $this->importProcessors[$alias];
    }
}
