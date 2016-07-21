<?php
use MPAPI\Services\Client;
use MPAPI\Services\Products;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('mp_mpapi_test_SAqqD_dGVzdHw0MDAw');
$products = new Products($mpapiClient);
// Get products
$response = $products->get();
var_dump($response);
// Get detail products
$response = $products->get(32059);
var_dump($response);
// Delete product
$response = $products->delete(30692);
var_dump($response);