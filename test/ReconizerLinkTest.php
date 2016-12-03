<?php
require_once("Services/RecognizerLink.php");

class RecognizerLinkTest extends PHPUnit_Framework_TestCase{

	public function setUp() {
		$this->classTested = '\Services\RecognizerLink';
	}

	//verifica se classe existe
	public function testClassExists()
	{
		$this->assertTrue(true, class_exists($this->classTested), 'Classe não existe');
	}

	public function testEqualSuccessReturn()
	{
		$class = new \Services\RecognizerLink();
		$class->setUrlProductStored('http://www.igio.com.br/123456');
		$class->setUrlProductVisited('http://www.igio.com.br/123456');
		$this->assertTrue($class->isEqual(), 'Tem que retornar true');
	}

	public function testEqualEmptyReturn()
	{
		$class = new \Services\RecognizerLink();
		$this->assertFalse($class->isEqual(), 'Tem que retornar false');
	}

	public function testPathUrl()
	{
		$class = new \Services\RecognizerLink();
		$this->assertFalse($class->getPathUrl(), 'Tem que retornar false');
	}

	public function testSetUrlProductStoredNull()
	{
		$class = new \Services\RecognizerLink();
		$this->assertInstanceOf('\Services\RecognizerLink', $class->setUrlProductStored(), 'Tem que retornar false');
	}

	public function testSetUrlProductVisitedNull()
	{
		$class = new \Services\RecognizerLink();
		$this->assertInstanceOf('\Services\RecognizerLink', $class->setUrlProductVisited(), 'Tem que retornar false');
	}

	public function testGetSetterNullStoredNull()
	{
		$class = new \Services\RecognizerLink();
		$this->assertEquals($class->getUrlProductStored(), null);
	}

	public function testGetSetterNullStoredUrl()
	{
		$class = new \Services\RecognizerLink();
		$class->setUrlProductStored('http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado');
		$this->assertEquals($class->getUrlProductStored(), [
			'scheme' => 'http',
			'host'   => 'www.lojadoze.com.br',
			'path'   => '/chapeu-caipira-de-palha-desfiado',
		]);
	}

	public function testGetSetterNullVisitedNull()
	{
		$class = new \Services\RecognizerLink();
		$this->assertEquals($class->getUrlProductVisited(), null);
	}

	public function testGetSetterNullVisitedUrl()
	{
		$class = new \Services\RecognizerLink();
		$class->setUrlProductVisited('http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado');
		$this->assertEquals($class->getUrlProductVisited(), [
			'scheme' => 'http',
			'host'   => 'www.lojadoze.com.br',
			'path'   => '/chapeu-caipira-de-palha-desfiado',
		]);
	}
}
