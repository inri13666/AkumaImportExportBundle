<?php

namespace Akuma\Bundle\ImportExportBundle\Model;

interface ImportModelInterface
{
    /**
     * @return array
     */
    public function getFields();

    /**
     * @return array
     */
    public function toArray();
}
