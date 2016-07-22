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

$data = [
	"id" => "pTU00_test",
	"title" => "Dont delete this product!",
	"shortdesc" => "Short decription of this book.",
	"longdesc" => "Stuha, kterou je každý z trojice balónků uvázán, aby se nevypustil. Očividně je uvázaná dostatečně pevně, protože balónky skutečně neucházejí. To ale není nic zvláštního. Překvapit by však mohl fakt, že nikdo, snad krom toho, kdo balónky k obloze vypustil, netuší, jakou má ona stuha barvu.",
	"category_id" => "MP002PL",
	"priority" => 1,
	"barcode" => "0000619262110",
	"price" => 200,
	"vat" => 10,
	"rrp" => 0,
	"media" => [
		"url" => "http=>//i.cdn.nrholding.net/15880228",
		"main" => true
	],
	"promotions" => [],
	"variants" => [

		"id" => "p50_white_XL",
		"title" => "Title of Book - black cover XL",
		"shortdesc" => "Short decription of book with black cover.",
		"longdesc" => "This black book is about long description. It can also contains simple formatting like",
		"priority" => 1,
		"barcode" => "0000619262110",
		"price" => 400,
		"rrp" => 229,
		"parameters" => [
			"MP_COLOR" => "blue"
		],
		"media" => [

			"url" => "http=>//i.cdn.nrholding.net/15880228",
			"main" => true

		],
		"promotions" => [

			"price" => 1700,
			"from" => "2015-07-19 00:00:00",
			"to" => "2018-11-14 23:59:59"

		],
		"availability" => [
			"status" => "A",
			"in_stock" => 1
		],
		"recommended" =>
			"pTU00_test"


	],
	"parameters" => [
		"MP_COLOR" => "blue"
	],
	"variable_parameters" => [
		"MP_COLOR"
	],
	"availability" => [
		"status" => "A",
		"in_stock" => 22
	],
	"labels" => [

		"label" => "SALE",
		"from" => "2015-07-19 00:00:00",
		"to" => "2018-11-14 23:59:59"

	],
	"delivery_setup" => null,
	"recommended" => [],
	"brand_id" => "Samsung"
];
// Create new product
$response = $products->post($data);
var_dump($response);

// Update product
$response = $products->put(29237, $data);
var_dump($response);
