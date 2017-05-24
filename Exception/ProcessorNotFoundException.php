<?php

namespace Akuma\Bundle\ImportExportBundle\Exception;

use Exception;

class ProcessorNotFoundException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $message = sprintf('"%s" not found', $message);

        parent::__construct($message, $code, $previous);
    }

}
