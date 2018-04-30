<?php
declare(strict_types=1);

namespace LinkRecognizer\Exception;

class ProductNotFoundException extends \Exception
{
    public function __construct($shopName, $link)
    {
        $exceptionMessage = sprintf(
            "Shop ($shopName) has no product associated to link given ($link).",
            $shopName,
            $link
        );

        parent::__construct($exceptionMessage);
    }
}
