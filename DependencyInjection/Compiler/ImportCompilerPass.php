<?php

namespace Akuma\Bundle\ImportExportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class ImportCompilerPass implements CompilerPassInterface
{
    use CompilerPassTrait;

    /**
     * @return string
     */
    public function getRegistryName()
    {
        return 'akuma.import_export.registry';
    }

    /**
     * @return string
     */
    public function getServiceTag()
    {
        return 'akuma_import.processor';
    }

    /**
     * @return string
     */
    public function getServiceMethod()
    {
        return 'addImportProcessor';
    }
}
