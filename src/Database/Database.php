<?php
declare(strict_types=1);

namespace LinkRecognizer\Database;

use LinkRecognizer\ProductCollection;

interface Database
{
    public function findProductsByShopName(string $shopName): ProductCollection;
}