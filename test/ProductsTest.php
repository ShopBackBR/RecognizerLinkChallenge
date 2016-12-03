<?php
require_once("Models/Products.php");

class ProductsTest extends PHPUnit_Framework_TestCase{

	public function setUp() {
		$this->classTested = '\Model\Products';
	}

	//verifica se classe existe
	public function testClassExists()
	{
		$this->assertTrue(true, class_exists($this->classTested), 'Classe não existe');
	}

	public function testIdGetSet()
	{
		$class = new \Models\Products();
		$class->setId('1');
		$this->assertEquals($class->getId(), 1, 'Tem que retornar 1');
	}

	public function testTitleGetSet()
	{
		$class = new \Models\Products();
		$class->setTitle('Produto de teste 1');
		$this->assertEquals($class->getTitle(), 'Produto de teste 1', 'Tem que retornar true');
	}

	public function testPriceGetSet()
	{
		$class = new \Models\Products();
		$class->setPrice(10.00);
		$this->assertEquals($class->getPrice(), 10.00,'Tem que ser 10.00');
	}

	public function testLinkGetSet()
	{
		$class = new \Models\Products();
		$class->setLink('http://www.lojadojoao.com.br/p/16599221');
		$this->assertEquals($class->getLink(), 'http://www.lojadojoao.com.br/p/16599221','Tem que retornar http://www.lojadojoao.com.br/p/16599221');
	}
}
