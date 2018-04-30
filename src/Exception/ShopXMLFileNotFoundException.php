<?php
declare(strict_types=1);

namespace LinkRecognizer\Exception;

class ShopXMLFileNotFoundException extends \Exception
{
    public function __construct($shopName, $path)
    {
        $exceptionMessage = sprintf(
            "Shop file ($shopName) not found on given path ($path)",
            $shopName,
            $path
        );

        parent::__construct($exceptionMessage);
    }
}
