<?php
// Here you can initialize variables that will be available to your tests
$product = [
	'id' => 'cdcept0123456',
	'title' => 'Testing Product',
	'shortdesc' => 'Short decription of this product.',
	'category_id' => 'MP001',
	'longdesc' => 'This product has long description. It can also contains simple formatting like <strong>bold text</strong>.',
	'priority' => 1,
	'vat' => 10,
	'brand_id' => 'SAMSUNG',
	'parameters' => [
		'MP_ATR_TEST1_CHAR' => 'test char value',
		'MP_ATR_TEST2_NUM' => 'test num value'
	],
	'variable_parameters' => [
		'MP_ATR_TEST1_CHAR',
		'MP_ATR_TEST2_NUM'
	],
	'availability' => [
		'status' => 'A',
		'in_stock' => 22
	],
	'labels' => [
		[
			'label' => 'NEW',
			'from' => '2027-10-11 00:00:00',
			'to' => '2027-10-11 00:00:00'
		]
	],
	'delivery_setup' => 'testDelivery1'
];

$media = [
	[
		'url' => 'https://i.cdn.nrholding.net/15880228',
		'main' => true
	],
	[
		'url' => 'https://i.cdn.nrholding.net/15880666',
		'main' => false
	]
];

Codeception\Util\Fixtures::add('inStock', $product['availability']['in_stock']);
Codeception\Util\Fixtures::add('status', $product['availability']['status']);
Codeception\Util\Fixtures::add('media', $media);

$variants = [
	[
		'id' => 'cdcept-v0123',
		'title' => 'Title of Product - codeception variant',
		'shortdesc' => 'Short decription of codeception variant of product.',
		'longdesc' => 'This codeception variant has long description. It can also contains simple formatting like <strong>bold text</strong>.',
		'priority' => 1,
		'barcode' => '22677170992',
		'price' => 185,
		'rrp' => 229,
		'parameters' => [
			'MP_ATR_TEST1_CHAR' => 'test char value',
			'MP_ATR_TEST2_NUM' => 'test num value'
		],
		'media' => [
			[
				'url' => 'https://i.cdn.nrholding.net/15880228',
				'main' => true
			]
		],
		'promotions' => [
			[
				'price' => 135,
				'from' => '2027-10-11 00:00:00',
				'to' => '2027-10-11 23:59:59'
			]
		],
		'availability' => [
			'status' => 'A',
			'in_stock' => 10
		]
	],
	[
		'id' => 'cdcept-v01234',
		'title' => 'Title of Book - codeception variant',
		'shortdesc' => 'Short decription of codeception variant of product.',
		'longdesc' => 'This codeception variant has long description. It can also contains simple formatting like <strong>bold text</strong>.',
		'priority' => 1,
		'barcode' => '22677170992',
		'price' => 185,
		'rrp' => 229,
		'parameters' => [
			'MP_ATR_TEST1_CHAR' => 'test char value',
			'MP_ATR_TEST2_NUM' => 'test num value'
		],
		'media' => [
			[
				'url' => 'https://i.cdn.nrholding.net/15880228',
				'main' => true
			],
			[
				'url' => 'https://i.cdn.nrholding.net/15880666',
				'main' => false
			]
		],
		'promotions' => [
			[
				'price' => 135,
				'from' => '2027-10-11 00:00:00',
				'to' => '2027-10-11 23:59:59'
			]
		],
		'availability' => [
			'status' => 'A',
			'in_stock' => 22
		]
	]
];

Codeception\Util\Fixtures::add('product', $product);

Codeception\Util\Fixtures::add('variantData', $variants[0]);

