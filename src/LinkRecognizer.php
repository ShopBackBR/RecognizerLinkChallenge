<?php
declare(strict_types=1);

namespace LinkRecognizer;

class LinkRecognizer
{
    private $database;

    public function __construct(Database\Database $database)
    {
        $this->database = $database;
    }

    public function recognize(string $shopName, string $visitedLink): Product
    {
        $visitedPath = $this->extractPathFromLink($visitedLink);

        $shopProducts = $this->database->findProductsByShopName($shopName);
        foreach ($shopProducts as $shopProduct) {
            $shopProductPath = $this->extractPathFromLink($shopProduct->getLink());

            if ($this->hasProductIdOnVisitedLinkPath($shopProduct->getId(), $visitedPath)) {
                return $shopProduct;
            }

            if ($this->hasMatchedSubstringOnBothLinkPath($visitedPath, $shopProductPath)) {
                return $shopProduct;
            }
        }

        throw new Exception\ProductNotFoundException($shopName, $visitedLink);
    }

    private function hasProductIdOnVisitedLinkPath(string $shopProductId, string $visitedLinkPath): bool
    {
        $explodedVisitedPath = explode('/', $visitedLinkPath);
        if (in_array($shopProductId, $explodedVisitedPath)) {
            return true;
        }

        $flattedVisitedPath = $this->flattenLinkPathByDelimiter($explodedVisitedPath);
        if(in_array($shopProductId, $flattedVisitedPath)) {
            return true;
        }
        return false;
    }

    private function hasMatchedSubstringOnBothLinkPath(string $visitedLinkPath, string $productLinkPath): bool
    {
        $explodedVisitedPath = explode('/', $visitedLinkPath);
        $explodedVisitedPath = $this->removeUselessLinkPath($explodedVisitedPath);

        $explodedShopProductPath = explode('/', $productLinkPath);

        $intersect = array_intersect($explodedVisitedPath, $explodedShopProductPath);

        return !empty($intersect);
    }

    private function flattenLinkPathByDelimiter(array $linkPath, string $delimiter = '-'): array
    {
        $parameters = [];
        foreach ($linkPath as $value) {
            $explodedParameters = explode($delimiter, $value);
            foreach ($explodedParameters as $parameter) {
                $parameters[] = $parameter;
            }
        }
        return $parameters;
    }

    private function removeUselessLinkPath(array $linkPath): array
    {
        $newLinkPath = array_filter($linkPath, function($value) {
            return strlen($value) > 1;
        });
        return $newLinkPath;
    }

    private function extractPathFromLink(string $link): string
    {
        $linkParsed = parse_url($link);
        return trim($linkParsed['path'], '/');
    }
}
