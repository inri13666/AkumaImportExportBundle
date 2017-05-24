<?php

namespace Akuma\Bundle\ImportExportBundle;

use Akuma\Bundle\ImportExportBundle\DependencyInjection\Compiler\ExportCompilerPass;
use Akuma\Bundle\ImportExportBundle\DependencyInjection\Compiler\ImportCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AkumaImportExportBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ImportCompilerPass());
        $container->addCompilerPass(new ExportCompilerPass());
    }
}
