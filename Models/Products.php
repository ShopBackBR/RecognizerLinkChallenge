<?php

namespace Models;

/**
 * Entidade do Produto
 * @author Raphael Giovanini
 **/
class Products
{

	/**
	 * Variável id
	 *
	 * @var int $id
	 * @column_name id
	 * @type id
	 **/
	public $id;

	/**
	 * Seta a variável de id
	 *
	 * @return void
	 **/
	public function setId($v){
		$this->id = $v;
		return $this;
	}

	/**
	 * Pegar o valor a variável de id
	 *
	 * @return id
	 **/
	public function getId(){
		return $this->id;
	}

	/**
	 * Variável título
	 *
	 * @var string $title
	 * @column_name title
	 * @type string
	 **/
	protected $title;

	/**
	 * Seta a variável de título
	 *
	 * @return void
	 **/
	public function setTitle($v){
		$this->title = $v;
		return $this;
	}

	/**
	 * Pegar o valor a variável de título
	 *
	 * @return string
	 **/
	public function getTitle(){
		return $this->title;
	}

	/**
	 * Variável de preço
	 *
	 * @var float $price
	 * @column_name price
	 * @type float
	 **/
	protected $price;

	/**
	 * Seta a variável de de preço
	 *
	 * @return void
	 **/
	public function setPrice($v){
		$this->price = $v;
		return $this;
	}

	/**
	 * Pegar o valor a variável de de preço
	 *
	 * @return float
	 **/
	public function getPrice(){
		return $this->price;
	}

	/**
	 * Variável url do produto
	 *
	 * @var string $link
	 * @column_name link
	 * @type string
	 **/
	protected $link;

	/**
	 * Seta a variável de url do produto
	 *
	 * @return void
	 **/
	public function setLink($v){
		$this->link = $v;
		return $this;
	}

	/**
	 * Pegar o valor a variável de url do produto
	 *
	 * @return string
	 **/
	public function getLink(){
		return $this->link;
	}
}
