<?php

namespace Services;

class CompareVisitorsData{

	private $recognizerLinkService;

	public function __construct($visitors = []){

		$this->recognizerLinkService = new \Services\RecognizerLink();

		if (count($visitors) > 0) {
			$this->setVisitors($visitors);
		}

	}

	/**
	 * Variável com visitas no site
	 *
	 * @var array $visitors
	 * @column_name visitors
	 * @type array
	 **/
	protected $visitors;

	/**
	 * Seta a variável com visitas no site
	 *
	 * @return void
	 **/
	public function setVisitors($v = []){
		$this->visitors = $v;
	}

	/**
	 * Pegar o valor a variável com visitas no site
	 *
	 * @return array
	 **/
	public function getVisitors(){
		return $this->visitors;
	}

	public function verify($url1, $url2){

		$isEqual = $this->recognizerLinkService->setUrlProductStored($url1)
			->setUrlProductVisited($url2)
			->isEqual();

		Out::s("\n\t - {$url1} = $url2 - ", false);

		$isEqual ? Out::g('sim') : Out::r('não');

		return $isEqual;
	}

	public function proccess($url){

		if (count($this->visitors) > 0) {

			foreach ($this->visitors as $visit) {

				$this->verify($url, $visit);

			}

		}

	}
}