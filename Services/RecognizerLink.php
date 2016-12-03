<?php

namespace Services;

class RecognizerLink
{
	/**
	 * @var
	 */
	private $urlProductStored;

	/**
	 * @var
	 */
	private $urlProductVisted;

	/**
	 * @param string $url
	 * @return Url parseada
	 */
	public function setUrlProductStored($url = '')
	{
		$this->urlProductStored = parse_url($url);
		return $this;
	}

	/**
	 * @param string $url
	 * @return Url parseada
	 */
	public function setUrlProductVisited($url = '')
	{
		$this->urlProductVisted = parse_url($url);
		return $this;
	}

	/**
	 * @return Url parseada
	 */
	public function getUrlProductStored()
	{
		return $this->urlProductStored;
	}

	/**
	 * @return Url parseada
	 */
	public function getUrlProductVisited()
	{
		return $this->urlProductVisted;
	}

	/**
	 * @param string $urlParsed
	 * @return Path da Url
	 */
	public function getPathUrl($urlParsed = [])
	{
		return isset($urlParsed['path']) ? $urlParsed['path'] : false;
	}

	/**
	 * @return Se a url é igual
	 */
	public function isEqual()
	{
		$x = array_filter(explode('/', $this->getPathUrl($this->getUrlProductStored())));
		$y = array_filter(explode('/', $this->getPathUrl($this->getUrlProductVisited())));

		return array_uintersect($x, $y, "strcasecmp") ? true : strstr(end($y), end($x)) || strstr(end($x), end($y)) ? true : false;
	}
}