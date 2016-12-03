<?php

require_once("Services/Out.php");
require_once("Services/RecognizerLink.php");
require_once("Services/PayloadHandler.php");
require_once("Services/CompareVisitorsData.php");
require_once("Models/Products.php");

use Services\Out;
use Services\CompareVisitorsData;
use Services\PayloadHandler;
use Models\Products;

Out::s(' - Iniciando', false, 'green');

//Configuração de XML
$clientsToRead = [
	'joao'  => ['name' => 'Loja do João',  'xml' => 'xml/joao.xml'],
	'maria' => ['name' => 'Loja da Maria', 'xml' => 'xml/maria.xml'],
	'jose'  => ['name' => 'Loja do José',  'xml' => 'xml/jose.xml'],
];


//Configuracao de visitas
$visitors = [
	'joao' => [
		'http://www.lojadojoao.com.br/',
		'http://www.lojadojoao.com.br/produto-de-teste-1-16599221',
		'http://www.lojadojoao.com.br/categoria-teste',
		'http://www.lojadojoao.com.br/search/helloword',
		'http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando',
	],
	'maria' => [
		'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack',
		'http://www.lojadamaria.com.br/search/helloword',
		'http://www.lojadamaria.com.br/categoria-legais',
		'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt',
	],
	'jose' => [
		'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado',
		'http://www.lojadoze.com.br/home',
		'http://www.lojadoze.com.br/categoria-teste',
		'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google',
	]
];

//Efetua o teste
if (count($clientsToRead) > 0 ) {

	$payloadHandler = new PayloadHandler();

	foreach ($clientsToRead as $k => $client) {

		echo "\n\n\t Lendo: {$client['name']} - {$client['xml']}\n";

		if($xml = $payloadHandler->readXml($client['xml'])){

			$productModel = new Products;

			$productModel->setId($xml->id)
				->setPrice($xml->price)
				->setTitle($xml->title)
				->setLink($xml->link);

			if (isset($visitors[$k])) {

				$compareService = new CompareVisitorsData($visitors[$k]);

				$compareService->proccess($productModel->getLink());

			}

		}

	}

}
