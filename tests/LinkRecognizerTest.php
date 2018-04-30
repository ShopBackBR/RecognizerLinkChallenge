<?php
declare(strict_types=1);

use LinkRecognizer\LinkRecognizer;
use LinkRecognizer\Database\Database;
use LinkRecognizer\Product;
use LinkRecognizer\ProductCollection;
use PHPUnit\Framework\TestCase;

class LinkRecognizerTest extends TestCase
{
    private $linkRecognizer;

    private $productIdURL = '123';

    private $productSubstringId = '111';
    private $productSubstring = 'product-some-description-on-url';

    public function setUp()
    {
        $databaseMock = $this->createMock(Database::class);
        $databaseMock->method('findProductsByShopName')
             ->willReturn(
                new ProductCollection([
                    new Product(
                        $this->productIdURL,
                        'Product with id on URL',
                        10,
                        "http://www.shopback.com.br/p/{$this->productIdURL}"
                    ),
                    new Product(
                        '111',
                        'Product with some description on url',
                        20,
                        "http://www.shopback.com.br/p/{$this->productSubstring}"
                    )
                ])
            );

        $this->linkRecognizer = new LinkRecognizer($databaseMock);
    }

    /**
     * @dataProvider provider_link_with_product_id
     */
    public function test_get_product_when_id_is_on_link($visitedLink, $expectedProduct)
    {
        $product = $this->linkRecognizer->recognize('shopback', $visitedLink);
        $this->assertEquals($expectedProduct, $product->getId());
    }

    public function provider_link_with_product_id()
    {
        return [
            'link with product id in the end' => [
                'visited link' => "http://www.shopback.com.br/produto-de-teste-1-{$this->productIdURL}",
                'expected product' => $this->productIdURL,
            ],
            'link with just product id' => [
                'visited link' => "http://www.shopback.com.br/{$this->productIdURL}",
                'expected product' => $this->productIdURL,
            ],
            'link messed and product id in the middle' => [
                'visited link' => "http://www.shopback.com.br/hahaha-{$this->productIdURL}-hehehe",
                'expected product' => $this->productIdURL,
            ],
            'link with just product id and query string' => [
                'visited link' => "http://www.shopback.com.br/{$this->productIdURL}?foo=bar",
                'expected product' => $this->productIdURL,
            ],
            'link with just expected substring' => [
                'visited link' => "http://www.shopback.com.br/{$this->productSubstring}",
                'expected product' => $this->productSubstringId,
            ],
            'link with more than one level and substring' => [
                'visited link' => "http://www.shopback.com.br/category/{$this->productSubstring}",
                'expected product' => $this->productSubstringId,
            ],
            'link with substring and query string' => [
                'visited link' => "http://www.shopback.com.br/{$this->productSubstring}?foo=bar",
                'expected product' => $this->productSubstringId,
            ]
        ];
    }

    /**
     * @expectedException LinkRecognizer\Exception\ProductNotFoundException
     */
    public function test_should_not_find_product_even_when_id_is_present_as_substring_mixed_with_other_value()
    {
        $databaseMock = $this->createMock(Database::class);
        $visitedLink = "http://www.shopback.com.br/p/{$this->productIdURL}4";
        $product = $this->linkRecognizer->recognize('shopback', $visitedLink);
    }

    /**
     * @expectedException LinkRecognizer\Exception\ProductNotFoundException
     */
    public function test_throw_exception_when_product_cannot_be_found()
    {
        $databaseMock = $this->createMock(Database::class);
        $visitedLink = 'http://www.shopback.com.br/home/teste/';
        $product = $this->linkRecognizer->recognize('shopback', $visitedLink);
    }
}
