<?php

namespace Services;

class PayloadHandler
{
	private $xml;

	public function readXml($url = '')
	{
		if (!file_exists($url)) {
			return false;
		}
		if($xml = simplexml_load_file($url)){
			$this->setXml($xml);
			return $this->getXml();
		}
	}

    /**
     * @param object $xml
     * @return XML com dados do produto
     */
	public function setXml($xml = false)
	{
		$this->xml = $xml;
		return $this;
	}

    /**
     * @return XML com dados do produto
     */
	public function getXml(){
		return $this->xml;
	}

}