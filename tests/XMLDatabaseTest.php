<?php
declare(strict_types=1);

use LinkRecognizer\Database\LocalXMLDatabase;
use PHPUnit\Framework\TestCase;

class LocalXMLDatabaseTest extends TestCase
{
    /**
     * @expectedException LinkRecognizer\Exception\DirectoryNotFoundException
     */
    public function test_wrong_xml_path_given()
    {
        new LocalXMLDatabase('WRONG_PATH');
    }

    public function test_get_list_of_product_from_given_shop()
    {
        $fixturesPath = __DIR__ . '/fixtures';
        $localXML = new LocalXMLDatabase($fixturesPath);
        $productColletion = $localXML->findProductsByShopName('joao');
        $this->assertCount(2, $productColletion);
    }

    /**
     * @expectedException LinkRecognizer\Exception\ShopXMLFileNotFoundException
     */
    public function test_shop_not_found_on_given_path()
    {
        $fixturesPath = __DIR__ . '/fixtures';
        $localXML = new LocalXMLDatabase($fixturesPath);
        $productColletion = $localXML->findProductsByShopName('haha');
        $this->assertCount(2, $productColletion);
    }
}
