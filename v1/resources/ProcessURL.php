<?php

namespace resources;

class ProcessURL {

    public function __construct() {
        $customer = new \resources\LoadCustomer();
        $this->urlProducts = $customer->loadXML();
    }

    public function validateURL($url) {
        $urlParsed = parse_url(strtolower($url));
        $urlParsed['path'] = ($urlParsed['path']);
        //empty path return void
        if (empty($urlParsed['path']) || $urlParsed['path'] == '/') {
            return;
        }

        //equal 
        foreach ($this->urlProducts[$urlParsed['host']] as $prod) {
            if ($prod->urlParsed['path'] === $urlParsed['path']) {
                return $prod;
            }
        }

        // by Position and id Product
        foreach ($this->urlProducts[$urlParsed['host']] as $prod) {
            $pathArr = explode('/', $urlParsed['path']);
            $pathEqual = $urlParsed['path'];
            foreach ($pathArr as $pt) {
                if (strlen($pt) > 2) {
                    $pathEqual = '/' . $pt . '/';
                }
            }

            if (strpos($prod->urlParsed['path'], $pathEqual) !== FALSE) {
                return $prod;
            }
            $patternProduct = '/^\/[\/a-z0-9_\-]*-([0-9]+)\/?/';
            $matches = [];
            if (preg_match($patternProduct, $urlParsed['path'], $matches)) {
                if ($prod->id == $matches[1]) {
                    return $prod;
                }
            }
        }
        return;
    }

}
