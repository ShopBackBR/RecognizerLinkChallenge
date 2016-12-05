<?php

namespace resources;

class LoadCustomer {

    CONST XML_CUSTOMER_DIRECTORY = __DIR__ . '/../../xmlCustomer';
    CONST XSD_VALIDATION = '<xs:schema attributeFormDefault="unqualified" elementFormDefault="qualified" xmlns:xs="http://www.w3.org/2001/XMLSchema">
  <xs:element name="items">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="item" maxOccurs="unbounded" minOccurs="1">
          <xs:complexType>
            <xs:sequence>
              <xs:element type="xs:string" name="id"/>
              <xs:element type="xs:string" name="title"/>
              <xs:element type="xs:float" name="price"/>
              <xs:element type="xs:anyURI" name="link"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>
      </xs:sequence>
    </xs:complexType>
  </xs:element>
</xs:schema>';

    private static $productsDB = [];
    private static $logErrorsOpenXML = [];

    public function loadXML() {

        if (!empty(self::$productsDB)) {
            return self::$productsDB;
        }

        if (!($handle = opendir(LoadCustomer::XML_CUSTOMER_DIRECTORY))) {
            return [];
        }
        while ((FALSE !== $fileName = readdir($handle))) {
            if ('xml' !== substr(strrchr($fileName, '.'), 1)) {
                continue;
            }
            $this->readXMLCustomerFile($fileName);
        }
        return self::$productsDB;
    }

    private function readXMLCustomerFile($fileName) {
        libxml_use_internal_errors(true);
        $xml = new \DOMDocument;
        $xml->Load(LoadCustomer::XML_CUSTOMER_DIRECTORY . '/' . $fileName);
        $xml->schemaValidateSource(LoadCustomer::XSD_VALIDATION);
        $errors = libxml_get_errors();
        if (count($errors) > 0) {
            $this->logErrorOpenXML($errors);
            return;
        }
        $this->fillDatabaseXMLCustomer($xml);
    }

    private function fillDatabaseXMLCustomer($xml) {
        $items = $xml->getElementsByTagName('item');
        foreach ($items as $item) {
            try {
                $children = $item->childNodes;
                $prod = new \models\Product();
                foreach ($children as $child) {
                    if (in_array($child->nodeName, ['id', 'title', 'price', 'link']))
                        $prod->{(string) $child->nodeName} = $child->nodeValue;
                }
                self::$productsDB[$prod->urlParsed['host']][] = $prod;
            } catch (\Exception $e) {
                $this->logErrorOpenXML($e);
            }
        }
    }

    private function logErrorOpenXML($errors) {
        self::$logErrorsOpenXML[] = $errors;
    }

    public function getLogErrorsOpenXML() {
        return self::$logErrorsOpenXML;
    }

}
