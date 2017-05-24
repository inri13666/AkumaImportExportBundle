<?php

namespace Akuma\Bundle\ImportExportBundle\Registry;

interface ProcessorInterface
{
    /**
     * @return string
     */
    public function getDescription();
}
