<?php

$version = 'v1';

require_once __DIR__ . "/../$version/autoload.php";

use resources\LoadCustomer;
use resources\ProcessURL;


echo PHP_EOL . '[LOG] INICIO===================';
echo PHP_EOL . '[LOG] CARREGANDO XMLs CLIENTES';

$failTest = 0;
$okTest = 0;

$lc = new LoadCustomer();
$lc->loadXML();

$errors = $lc->getLogErrorsOpenXML();
if (count($errors) > 0) {
    echo PHP_EOL . 'Erro: ';
    foreach ($errors as $erro) {
        echo $erro[0]->file . PHP_EOL . $erro[0]->message;
    }

    echo PHP_EOL . '[LOG] O teste não prosseguirá';
    echo PHP_EOL . '[LOG] Foi REPROVADO';
    echo PHP_EOL . '[LOG] ======================FIM';
    exit();
}


echo PHP_EOL . '[LOG] PROCESSANDO BATCH URLS';

$prc = new ProcessURL();
foreach (
[
    ['file' => 'urlsValidProducts.csv', 'result' => 'valid'],
    ['file' => 'urlsInvalidProducts.csv', 'result' => 'invalid'],
] as $fp) {
    
    $mustFind = $fp['result'] == 'valid';
    
    $lines = array_map(function($line) {
        return str_getcsv($line);
    }, file(__DIR__.'/'.$fp['file']));
    
    
    foreach ($lines as $ln) {
        $prd = $prc->validateURL($ln[0]);
        if ($mustFind) {
            if (empty($prd) || $ln[1] != $prd->id) {
                echo PHP_EOL . $ln[0] . ' REPROVOU não achou produto ' . $ln[1] . 
                        (!empty($prd)?' Encontrou ' . $prd->id : '');
                $failTest++;
            }
            else {
                $okTest++;
            }
        } else {
            if (count($prd)) {
                echo PHP_EOL . $ln[0] . ' REPROVOU achou produto' . $prd->id;
                $failTest++;
            } else {
                $okTest++;
            }
        }
    }
}

echo PHP_EOL . "[LOG] Aprovou $okTest testes de URLs";
echo PHP_EOL . "[LOG] Reprovou $failTest testes de URLs";
echo PHP_EOL . '[LOG] ======================FIM';
echo PHP_EOL;