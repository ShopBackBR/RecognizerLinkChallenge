<?php

namespace models;

class Product {

    private $id;
    private $title;
    private $price;
    private $link;
    public $urlParsed;

    public function __set($name, $value) {
        if (is_callable([$this,$name . 'Valid']) && $this->{$name . 'Valid'}($value)) {
            return $this->$name = $value;
        }
        throw new \Exception("Property $name not localized");
    }
    
    public function __get($name) {
        return $this->$name;
    }

    private function idValid($value) {
        return !empty($value);
    }

    private function titleValid($value) {
        return !empty($value);
    }

    private function priceValid($value) {
        return is_numeric($value);
    }

    private function linkValid($value) {
        $ret = filter_var($value, FILTER_VALIDATE_URL);
        if ($ret){
            $this->parseURL($value);
        }
        return $ret;
    }

    private function parseURL($value){
        $this->urlParsed = parse_url(strtolower($value));
    }
}
