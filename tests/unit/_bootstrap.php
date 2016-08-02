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

$orderData = [
	'id' => 8888888801,
	'purchase_id' => 88888888,
	'external_order_id' => 11,
	'currency' => 'CZK',
	'delivery_price' => 0,
	'cod_price' => 0,
	'discount' => 0,
	'delivery_method' => 'partner_delivery_id',
	'delivery_method_id' => 1111,
	'ship_date' => '2016-03-16',
	'delivery_date' => '2016-03-16',
	'cod' => 71.98,
	'address' => [
		'name' => 'Fisrtname Lastname',
		'phone' => '720000000',
		'email' => 'info@mall.cz',
		'street' => 'Street',
		'city' => 'City',
		'zip' => '10000',
		'country' => 'CZ',
	],
	'confirmed' => true,
	'status' => 'returned',
	'items' => [
		[
			'id' => 'productId1',
			'quantity' => 1,
			'price' => 35.07,
			'vat' => 21,
		],
		[
			'id' => 'productID2',
			'quantity' => 1,
			'price' => 36.91,
			'vat' => 21,
		]
	]
];
Codeception\Util\Fixtures::add('orderData', $orderData);

// delivery method data
$deliveryMethodData = [
	'id' => 'deliveryMethodId',
	'title' => 'Delivery method title',
	'price' => 150,
	'cod_price' => 35,
	'free_limit' => 1000,
	'delivery_delay' => 3,
	'is_pickup_point' => true
];
Codeception\Util\Fixtures::add('deliveryMethodData', $deliveryMethodData);
Codeception\Util\Fixtures::add('updatedDeliveryMethodId', 'updatedDeliverMethodId');
Codeception\Util\Fixtures::add('updatedDeliveryMethodTitle', 'Updated delivery method title');
Codeception\Util\Fixtures::add('updatedDeliveryMethodPrice', 300);
Codeception\Util\Fixtures::add('updatedDeliveryMethodCodPrice', 10);
Codeception\Util\Fixtures::add('updatedDeliveryMethodFreeLimit', 0);
Codeception\Util\Fixtures::add('updatedDeliveryMethodDeliveryDelay', 8);
Codeception\Util\Fixtures::add('updatedDeliveryMethodPickupPoint', false);

// delivery setup data
$deliverySetupData = [
	'id' => 'deliverySetupId',
	'price' => 150,
	'cod_price' => 22,
	'free_limit' => 650,
	'delivery_delay' => 4
];

Codeception\Util\Fixtures::add('deliverySetupData', $deliverySetupData);
Codeception\Util\Fixtures::add('updatedDeliverySetupId', 'updatedDeliverSetupId');
Codeception\Util\Fixtures::add('updatedDeliverySetupPrice', 200);
Codeception\Util\Fixtures::add('updatedDeliverySetupCodPrice', 10);
Codeception\Util\Fixtures::add('updatedDeliverySetupFreeLimit', 0);
Codeception\Util\Fixtures::add('updatedDeliverySetupDeliveryDelay', 8);
