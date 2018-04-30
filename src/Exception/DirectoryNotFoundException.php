<?php
declare(strict_types=1);

namespace LinkRecognizer\Exception;

class DirectoryNotFoundException extends \Exception
{
    public function __construct($path)
    {
        $exceptionMessage = sprintf(
            "Directory ($path) not exists",
            $path
        );

        parent::__construct($exceptionMessage);
    }
}
