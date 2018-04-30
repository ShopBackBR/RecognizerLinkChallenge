<?php
declare(strict_types=1);

namespace LinkRecognizer\Database;

use LinkRecognizer\Product;
use LinkRecognizer\Exception\DirectoryNotFoundException;
use LinkRecognizer\Exception\ShopXMLFileNotFoundException;
use LinkRecognizer\ProductCollection;

class LocalXMLDatabase implements Database
{
    private $filesPath;

    public function __construct(string $filesPath)
    {
        if (!file_exists($filesPath)) {
            throw new DirectoryNotFoundException($filesPath);
        }

        $this->filesPath = $filesPath;
    }

    public function findProductsByShopName(string $shopName): ProductCollection
    {
        $productDocument = $this->loadXML($shopName);
        return $this->hydrateProductCollection($productDocument);
    }

    private function hydrateProductCollection(\DOMDocument $document): ProductCollection
    {
        $productCollection = new ProductCollection();
        $items = $document->getElementsByTagName('item');
        foreach ($items as $item) {
            $product = new Product(
                $item->getElementsByTagName('id')->item(0)->nodeValue,
                $item->getElementsByTagName('title')->item(0)->nodeValue,
                (float) $item->getElementsByTagName('price')->item(0)->nodeValue,
                $item->getElementsByTagName('link')->item(0)->nodeValue
            );

            $productCollection->append($product);
        }

        return $productCollection;
    }

    private function loadXML($shopName): \DOMDocument
    {
        $document = new \DOMDocument();

        libxml_use_internal_errors(true);
        $wasLoaded = $document->load($this->filesPath . '/' . $shopName . '.xml');
        if (!$wasLoaded) {
            throw new ShopXMLFileNotFoundException($shopName, $this->filesPath);
        }
        libxml_use_internal_errors(false);

        return $document;
    }
}
