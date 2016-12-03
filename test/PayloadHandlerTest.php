<?php
require_once("Services/PayloadHandler.php");

class PayloadHandlerTest extends PHPUnit_Framework_TestCase{

	public function setUp() {
		$this->classTested = '\Services\PayloadHandler';
	}

	//verifica se classe existe
	public function testClassExists()
	{
		$this->assertTrue(true, class_exists($this->classTested), 'Classe não existe');
	}

	public function testXmlNull()
	{
		$class = new \Services\PayloadHandler();
		$this->assertFalse($class->readXml());
	}

	public function testXmlFull()
	{
		$class = new \Services\PayloadHandler();
		$this->assertFileExists('xml/jose.xml');
		$this->assertXmlStringEqualsXmlFile($class->readXml('xml/jose.xml'),'<item><id>8595</id><title>Produto Sem Nome</title><price>140.00</price><link>http://www.lojadoze.com.br/p/chapeu-caipira-de-palha-desfiado/campanha_id/34</link></item>');
	}

}
