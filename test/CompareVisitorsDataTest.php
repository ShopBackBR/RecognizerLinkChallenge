<?php
require_once("Services/CompareVisitorsData.php");
require_once("Services/RecognizerLink.php");
require_once("Services/Out.php");

class CompareVisitorsDataTest extends PHPUnit_Framework_TestCase{

	public function setUp() {
		$this->classTested = '\Services\CompareVisitorsDataTest';
	}

	//verifica se classe existe
	public function testClassExists()
	{
		$this->assertTrue(true, class_exists($this->classTested), 'Classe não existe');
	}

	public function testEqualSuccessReturn()
	{
		$class = new \Services\CompareVisitorsData();
		$visitors = [
			'http://www.lojadojoao.com.br/',
			'http://www.lojadojoao.com.br/produto-de-teste-1-16599221',
			'http://www.lojadojoao.com.br/categoria-teste',
			'http://www.lojadojoao.com.br/search/helloword',
			'http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando',
		];
		$class->setVisitors($visitors);
		$this->assertEquals($class->getVisitors(), $visitors, 'Tem que retornar true');
	}

	public function testVerify()
	{
		$class = new \Services\CompareVisitorsData();

		$this->assertTrue($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221'), 'Tem que retornar true');
		$this->assertTrue($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando'), 'Tem que retornar true');
		$this->assertTrue($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221'), 'Tem que retornar true');
		$this->assertTrue($class->verify('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/t/2/campanha_id/+752+', 'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt'), 'Tem que retornar true');
		$this->assertTrue($class->verify('http://www.lojadoze.com.br/p/chapeu-caipira-de-palha-desfiado/campanha_id/34', 'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado'), 'Tem que retornar true');


		$this->assertFalse($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/'), 'Tem que ser falso');
		$this->assertTrue($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221'), 'Tem que ser verdadeiro');
		$this->assertFalse($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/categoria-teste'), 'Tem que ser falso');
		$this->assertFalse($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/search/helloword'), 'Tem que ser falso');
		$this->assertTrue($class->verify('http://www.lojadojoao.com.br/p/16599221', 'http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando'), 'Tem que ser verdadeiro');
		$this->assertTrue($class->verify('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/t/2/campanha_id/+752+', 'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack'), 'Tem que ser verdadeiro');
		$this->assertFalse($class->verify('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/t/2/campanha_id/+752+', 'http://www.lojadamaria.com.br/search/helloword'), 'Tem que ser falso');
		$this->assertFalse($class->verify('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/t/2/campanha_id/+752+', 'http://www.lojadamaria.com.br/categoria-legais'), 'Tem que ser falso');
		$this->assertTrue($class->verify('http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/t/2/campanha_id/+752+', 'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt'), 'Tem que ser verdadeiro');
		$this->assertTrue($class->verify('http://www.lojadoze.com.br/p/chapeu-caipira-de-palha-desfiado/campanha_id/34', 'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado'), 'Tem que ser verdadeiro');
		$this->assertFalse($class->verify('http://www.lojadoze.com.br/p/chapeu-caipira-de-palha-desfiado/campanha_id/34', 'http://www.lojadoze.com.br/home'), 'Tem que ser falso');
		$this->assertFalse($class->verify('http://www.lojadoze.com.br/p/chapeu-caipira-de-palha-desfiado/campanha_id/34', 'http://www.lojadoze.com.br/categoria-teste'), 'Tem que ser falso');


	}
}
