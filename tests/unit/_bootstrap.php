<?php
// Here you can initialize variables that will be available to your tests
$product = [
	'id' => 'cdcept0123456',
	'article_id' => 100000342333,
	'title' => 'Testing Product',
	'url' => '"https://www.mall.cz/id/100000342333',
	'shortdesc' => 'Short decription of this product.',
	'category_id' => 'MP001',
	'longdesc' => 'This product has long description. It can also contain simple formatting like <strong>bold text</strong>.',
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
	'delivery_delay' => 2
];

$deliveryError = [
	'code' => 'TEST_CODE',
	'msg' => 'Test msg',
	'value' => 'testValue',
	'attribute' => 'testAttribute',
	'articles' => [3, 7, 4]
];

$media = [
	[
		'url' => 'https://i.cdn.nrholding.net/15880228',
		'main' => true
	],
	[
		'url' => 'https://i.cdn.nrholding.net/15880666',
	],
	[
		'url' => 'https://i.cdn.nrholding.net/15880666',
		'main' => false,
		'switch' => true
	]
];

$ordinaryMedia = [
	'url' => 'https://i.cdn.nrholding.net/15880666',
	'main' => false,
	'switch' => false
];

$mainMedia = [
	'url' => 'https://i.cdn.nrholding.net/15880228',
	'main' => true,
	'switch' => false
];

Codeception\Util\Fixtures::add('inStock', $product['availability']['in_stock']);
Codeception\Util\Fixtures::add('status', $product['availability']['status']);
Codeception\Util\Fixtures::add('media', $media);
Codeception\Util\Fixtures::add('ordinaryMedia', $ordinaryMedia);
Codeception\Util\Fixtures::add('mainMedia', $mainMedia);
Codeception\Util\Fixtures::add('deliveryError', $deliveryError);

$variants = [
	[
		'id' => 'cdcept-v0123',
		'article_id' => 100000342798,
		'title' => 'Title of Product - codeception variant',
		'shortdesc' => 'Short decription of codeception variant of product.',
		'longdesc' => 'This codeception variant has long description. It can also contain simple formatting like <strong>bold text</strong>.',
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
				'main' => true,
				'switch' => true
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
		'article_id' => 100000342799,
		'title' => 'Title of Book - codeception variant',
		'shortdesc' => 'Short decription of codeception variant of product.',
		'longdesc' => 'This codeception variant has long description. It can also contain simple formatting like <strong>bold text</strong>.',
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

$variant = [
	'id' => 'cdcept-v0123',
	'article_id' => 100000342798,
	'title' => 'Title of Product - codeception variant',
	'shortdesc' => 'Short decription of codeception variant of product.',
	'longdesc' => 'This codeception variant has long description. It can also contain simple formatting like <strong>bold text</strong>.',
	'priority' => 1,
	'barcode' => '22677170992',
	'price' => 185,
	'rrp' => 229,
	'parameters' => [
		'MP_ATR_TEST1_CHAR' => 'test char value',
		'MP_ATR_TEST2_NUM' => 'test num value'
	],
	'labels' => [],
	'media' => [
		[
			'url' => 'https://i.cdn.nrholding.net/15880228',
			'main' => true,
			'switch' => 'MP_ATR_TEST1_CHAR'
		]
	],
	'promotions' => [],
	'dimensions' => [],
	'availability' => [
		'status' => 'A',
		'in_stock' => 10
	],
	'recommended' => [],
	'delivery_delay' => 2
];
Codeception\Util\Fixtures::add('variant', $variant);
Codeception\Util\Fixtures::add('variantInStock', $variant['availability']['in_stock']);
Codeception\Util\Fixtures::add('variantStatus', $variant['availability']['status']);

$promotions = [
	'price' => 135,
	'from' => '2027-10-11 00:00:00',
	'to' => '2027-10-11 23:59:59'
];
Codeception\Util\Fixtures::add('promotions', $promotions);
$labels = [
	'label' => 'NEW',
	'from' => '2018-01-01 00:00:00',
	'to' => '2020-03-01 00:00:00'
];
Codeception\Util\Fixtures::add('labels', $labels);

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
	'tracking_number' => 'T9999999999',
	'tracking_url' => 'http://test.test',
	'ship_date' => '2016-03-16',
	'delivery_date' => '2016-03-16',
	'delivered_at' => '2018-02-14 08:03:00',
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
	'status' => 'delivered',
	'items' => [
		[
			'id' => 'productId1',
			'article_id' => 100000294681,
			'quantity' => 1,
			'price' => 35.07,
			'vat' => 21,
			'commission' => 16
		],
		[
			'id' => 'productID2',
			'article_id' => 100000249018,
			'quantity' => 1,
			'price' => 36.91,
			'vat' => 21,
			'commission' => 11.5
		]
	],
	'mdp' => false,
	'branches' => [
		'overridden' => false,
	],
	'ready_to_return' => false,
];
Codeception\Util\Fixtures::add('orderData', $orderData);

// deliveries
$partnerDelivery = [
	'code' => 'new_delivery',
	'title' => 'NEW delivery',
	'price' => 100,
	'cod_price' => 0,
	'free_limit' => 1000,
	'delivery_delay' => 3,
	'is_pickup_point' => true,
	'height' => [
		'min' => 0,
		'max' => 120
	],
	'length' => [
		'min' => 0,
		'max' => 100
	],
	'width' => [
		'min' => 0,
		'max' => 100
	],
	'weight' => [
		'min' => 0,
		'max' => 30
	],
	'priority' => 1,
	'partner_id' => 3000,
	'delivery_method_id' => 1

];
Codeception\Util\Fixtures::add('partnerDelivery', $partnerDelivery);

$generalDelivery = [
	'code' => 'CP',
	'title' => 'Česká pošta',
	'description' => 'Česká pošta',
	'tracking_url' => 'http=>//www.ceskaposta.cz/cz/nastroje/sledovani-zasilky.php?barcode=%TRACKING_NUMBER%&amp;send=submit&amp;go=ok',
	'price' => 99,
	'cod_price' => 40,
	'free_limit' => 1000,
	'delivery_delay' => 2,
	'height' => [
		'min' => 10,
		'max' => 15
	],
	'length' => [
		'min' => 20,
		'max' => 25
	],
	'width' => [
		'min' => 30,
		'max' => 35
	],
	'weight' => [
		'min' => 0,
		'max' => 1
	],
	'active' => true
];
Codeception\Util\Fixtures::add('generalDelivery', $generalDelivery);
Codeception\Util\Fixtures::add('newTrackingUrl', $generalDelivery);

$pricingLevelsData = [
	[
		'type' => 'p',
		'price' => 120,
		'cod_price' => 40,
		'limit' => 1000
	]
];

Codeception\Util\Fixtures::add('pricingLevelsData', $pricingLevelsData);

// Product basic data
$basicProduct = [
	'id' => 'TP',
	'product_id' => 100000305492,
	'title' => 'Testing product',
	'category_id' => 'MP001',
	'variants_count' => 1,
	'has_variants' => true,
	'status' => 'A'
];
Codeception\Util\Fixtures::add('productBasicData', $basicProduct);
