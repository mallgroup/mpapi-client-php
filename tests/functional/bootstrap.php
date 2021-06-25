<?php declare(strict_types=1);

namespace MpApiClient\Tests\functional;

use Codeception\Util\Fixtures;
use DateTime;
use MpApiClient\Article\DTO\ProductRequest;
use MpApiClient\Article\DTO\VariantRequest;
use MpApiClient\Article\Entity\Common\Availability;
use MpApiClient\Article\Entity\Common\Media;
use MpApiClient\Article\Entity\Common\MediaIterator;
use MpApiClient\Article\Entity\Common\Parameter;
use MpApiClient\Article\Entity\Common\ParameterIterator;
use MpApiClient\Article\Entity\Common\StatusEnum as ArticleStatusEnum;
use MpApiClient\Order\Entity\StatusEnum as OrderStatusEnum;

Fixtures::add('categoryId', 'MP001');
Fixtures::add(
    'categoryParameters',
    [
        'MP_ATR_TEST1_CHAR' => [
            'param_id' => 'MP_ATR_TEST1_CHAR',
            'title'    => 'Market place test 1 znaky',
            'unit'     => '',
            'values'   => [],
        ],
        'MP_ATR_TEST2_NUM'  => [
            'param_id' => 'MP_ATR_TEST2_NUM',
            'title'    => 'Market place test 2 čísla',
            'unit'     => '',
            'values'   => [],
        ],
    ],
);

Fixtures::add('invoiceId', '99991111');
Fixtures::add(
    'invoice',
    [
        'invoiceNumber'    => 99991111,
        'partner'          => '3000',
        'createdAt'        => new DateTime('2018-11-23 00:00:00'),
        'deliveryAt'       => new DateTime('2018-11-26 00:00:00'),
        'dueDate'          => new DateTime('2018-11-26 00:00:00'),
        'currency'         => 'CZK',
        'supplier'         => [
            'bank'               => [
                'iban'        => 'CZ8100161984000098459001',
                'swift'       => 'GXCAMCZX',
                'bankName'    => 'Česká spořitelna',
                'bankAccount' => '1000084488/0800',
            ],
            'name'               => 'Novak s.r.o',
            'registrationNumber' => '123456789',
            'taxIdentification'  => 'CZ123456789',
            'vatNumber'          => '3210480832',
            'note'               => '',
            'address'            => [
                'street'  => 'U Garáží 1',
                'city'    => 'Praha',
                'zip'     => '17001',
                'country' => 'CZ',
            ],
        ],
        'customer'         => [
            'name'               => 'Internet Mall s.r.o',
            'registrationNumber' => '26204967',
            'taxIdentification'  => 'CZ26204967',
            'vatNumber'          => '3210480832',
            'note'               => '',
            'address'            => [
                'street'  => 'U Garáží 1',
                'city'    => 'Praha',
                'zip'     => '17001',
                'country' => 'CZ',
            ],
        ],
        'items'            => [
            [
                'id'              => 'IDP29826',
                'articleId'       => 1100051914,
                'title'           => 'Produckt 1',
                'titleEn'         => '',
                'quantity'        => 1,
                'unit'            => 'KS',
                'unitPrice'       => 200.0,
                'vatPrice'        => 0.0,
                'priceWithoutVat' => 200.2,
                'vatRate'         => 21,
                'totalPrice'      => 200.0,
                'orderId'         => 206054198198,
            ],
        ],
        'filePath'         => '3000/attachment',
        'total'            => 1000.0,
        'taxRecap'         => [
            'total' => 200.0,
            'taxes' => [
                [
                    'tax'   => '15',
                    'base'  => 190.0,
                    'total' => 200.0,
                    'price' => 19.0,
                ],
                [
                    'tax'   => '21',
                    'base'  => 190.0,
                    'total' => 200.0,
                    'price' => 19.0,
                ],
                [
                    'tax'   => 'osvobozeno',
                    'base'  => 190.0,
                    'total' => 200.0,
                    'price' => 19.0,
                ],
            ],
        ],
        'note'             => '',
        'purchNoC'         => '',
        'invoiceType'      => 'SB',
        'invoiceIndicator' => 'I',
        'documentType'     => 'invoice',
        'invoiceTypeTag'   => 'SB',
    ],
);

Fixtures::add('offsetId', '0000003000-28032019');
Fixtures::add(
    'offset',
    [
        'partner'        => '3000',
        'documentNumber' => '0000003000-28032019',
        'createdAt'      => new DateTime('2019-03-28 00:00:00'),
        'dueDate'        => new DateTime('2018-12-07 00:00:00'),
        'currency'       => 'CZK',
        'diffPrice'      => -2550.91,
        'variableSymbol' => 3003190328,
        'supplier'       => [
            'name'               => 'VIVANTIS a.s.',
            'registrationNumber' => '25977687',
            'taxIdentification'  => 'CZ25977687',
            'vatNumber'          => 'CZ25977687',
            'note'               => '',
            'address'            => [
                'street'  => 'Školní náměstí 14',
                'city'    => 'Chrudim',
                'zip'     => '537 01',
                'country' => 'CZ',
            ],
        ],
        'customer'       => [
            'name'               => 'Internet Mall, a.s.',
            'registrationNumber' => '26204967',
            'taxIdentification'  => 'CZ26204967',
            'vatNumber'          => 'CZ26204967',
            'note'               => '',
            'address'            => [
                'street'  => 'U garáží 1611/1',
                'city'    => 'Praha 7 - Holešovice',
                'zip'     => '170 00',
                'country' => 'CZ',
            ],
        ],
        'invoices'       => [
            [
                'id'            => 3003000034,
                'created'       => new DateTime('2018-11-23 00:00:00'),
                'dueDate'       => new DateTime('2018-12-07 00:00:00'),
                'sumPrice'      => 2973.91,
                'offsetPrice'   => 423,
                'remainPrice'   => 2550.91,
                'currency'      => 'CZK',
                'purchNoC'      => '',
                'note'          => '',
                'invoiceNumber' => '',
            ],
        ],
        'orders'         => [
            [
                'id'          => 10016693501,
                'created'     => new DateTime('2019-03-27 00:00:00'),
                'dueDate'     => new DateTime('2019-04-10 00:00:00'),
                'sumPrice'    => -423,
                'offsetPrice' => -423,
                'remainPrice' => 0,
                'currency'    => 'CZK',
            ],
        ],
        'attachment'     => [
            'filename' => 'MP_offset_0000003000-28032019.PDF',
            'mime'     => 'application/pdf',
        ],
    ],
);

Fixtures::add('orderId', 232342423102);

Fixtures::add(
    'order',
    [
        'id'                      => 232342423102,
        'purchase_id'             => 2323424231,
        'external_order_id'       => 0,
        'currency'                => 'CZK',
        'delivery_price'          => 99.1,
        'cod_price'               => 10,
        'cod'                     => 111,
        'discount'                => 100.1,
        'payment_type'            => 'A',
        'delivery_method'         => '123',
        'delivery_method_id'      => 123,
        'branches'                => [
            'overridden' => false,
        ],
        'tracking_number'         => 'ABRA0001',
        'ship_date'               => new DateTime('2018-02-01 00:00:00'),
        'delivery_date'           => new DateTime('2018-02-01 00:00:00'),
        'address'                 => [
            'customer_id' => 1000929311,
            'name'        => 'Josef Novák',
            'company'     => 'U garážá 1',
            'phone'       => '+420701000001',
            'email'       => 'info@mall.cz',
            'street'      => 'U garážá 1',
            'city'        => 'Praha',
            'zip'         => '17001',
            'country'     => 'CZ',
        ],
        'confirmed'               => true,
        'status'                  => new OrderStatusEnum('shipping'),
        'items'                   => [
            [
                'id'             => '845841AB',
                'article_id'     => 100000738462,
                'quantity'       => 1,
                'price'          => 1000.1,
                'vat'            => 21,
                'commission'     => 12.1,
                'title'          => '',
                'serial_numbers' => [],
            ],
        ],
        'test'                    => false,
        'mdp'                     => false,
        'ready_to_return'         => true,
        'shipped'                 => new DateTime('2020-01-09 12:08:56'),
        'open'                    => new DateTime('2020-01-09 13:33:49'),
        'lost'                    => new DateTime('2019-08-01 10:41:13'),
        'returned'                => new DateTime('2019-04-29 15:25:09'),
        'delivered'               => new DateTime('2019-04-29 15:24:52'),
        'shipping'                => new DateTime('2021-03-16 12:49:28'),
        'ulozenka_status_history' => [],
    ],
);

Fixtures::add(
    'article-media',
    new MediaIterator(
        new Media('https://i.cdn.nrholding.net/21749465', true),
        new Media('https://i.cdn.nrholding.net/21749466', false, null, true, false),
    ),
);

Fixtures::add(
    'article-availability',
    new Availability(ArticleStatusEnum::ACTIVE(), 1),
);

// Returns function, to avoid issues with references and cloning
Fixtures::add(
    'product',
    function (): ProductRequest {
        return new ProductRequest(
            'mpapi-client-test-product-id-not-set',
            'MPAPI client test product',
            'This is a test product created by MPAPI client tests',
            'This is a <em>test product</em> created by <strong>MPAPI client</strong> <u>functional</u> tests',
            'MP001',
            21,
            1,
        );
    },
);

// Returns function, to avoid issues with references and cloning
Fixtures::add(
    'variant',
    function (): VariantRequest {
        return new VariantRequest(
            'mpapi-client-test-variant-id-not-set',
            'MPAPI client test variant',
            'This is a test variant created by MPAPI client tests',
            'This is a <em>test variant</em> created by <strong>MPAPI client</strong> <u>functional</u> tests',
            1,
            69,
            Fixtures::get('article-media'),
            new ParameterIterator(Parameter::create('MP_ATR_TEST1_CHAR', 'a', 'b', 'c')),
        );
    }
);
