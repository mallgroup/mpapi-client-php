# FinancialClient

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of all invoices

Method returns [InvoiceList](../src/Financial/Entity/Invoice/InvoiceList.php) containing [Invoice](../src/Financial/Entity/Invoice/Invoice.php) entity.

```php
use MpApiClient\Common\Interfaces\FinancialClientInterface;

/** @var FinancialClientInterface $financialClient */
$labels = $financialClient->listInvoices(null);
echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "paging": {
    "total": 10,
    "pages": 1,
    "size": 10,
    "page": 1
  },
  "data": [
    {
      "invoiceNumber": 99991111,
      "partner": "3000",
      "createdAt": "2018-11-23 00:00:00",
      "deliveryAt": "2018-11-26 00:00:00",
      "dueDate": "2018-11-26 00:00:00",
      "originDocumentId": null,
      "currency": "CZK",
      "supplier": {
        "bank": {
          "bankName": "Česká spořitelna",
          ...
        }
      },
      "customer": {
        "name": "Internet Mall s.r.o",
        ...
        "address": {
          "street": "U Garáží 1",
          "city": "Praha",
          "zip": "17001",
          "country": "CZ"
        }
      },
      "items": [
        {
          "id": "IDP29826",
          ...
        }
      ],
      "filePath": "3000\/attachment",
      "total": 1000,
      "taxRecap": {
        "total": 200,
        "taxes": [
          {
            "tax": "15",
            "base": 190,
            "total": 200,
            "price": 19
          },
          ...
        ]
      },
      "note": "",
      "purchNoC": "",
      "invoiceType": "SB",
      "invoiceIndicator": "I",
      "documentType": "invoice",
      "invoiceTypeTag": "SB"
    },
    ...
  ]
}
```

## Get invoice detail

Method returns [Invoice](../src/Financial/Entity/Invoice/Invoice.php) entity.

```php
use MpApiClient\Common\Interfaces\FinancialClientInterface;

/** @var FinancialClientInterface $financialClient */
$labels = $financialClient->getInvoice('invoice-id');
echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "invoiceNumber": 99991111,
  "partner": "3000",
  "createdAt": "2018-11-23 00:00:00",
  "deliveryAt": "2018-11-26 00:00:00",
  "dueDate": "2018-11-26 00:00:00",
  "originDocumentId": null,
  "currency": "CZK",
  "supplier": {
    "bank": {
      "bankName": "Česká spořitelna",
      ...
    }
  },
  "customer": {
    "name": "Internet Mall s.r.o",
    ...
    "address": {
      "street": "U Garáží 1",
      "city": "Praha",
      "zip": "17001",
      "country": "CZ"
    }
  },
  "items": [
    {
      "id": "IDP29826",
      ...
    }
  ],
  "filePath": "3000\/attachment",
  "total": 1000,
  "taxRecap": {
    "total": 200,
    "taxes": [
      {
        "tax": "15",
        "base": 190,
        "total": 200,
        "price": 19
      },
      ...
    ]
  },
  "note": "",
  "purchNoC": "",
  "invoiceType": "SB",
  "invoiceIndicator": "I",
  "documentType": "invoice",
  "invoiceTypeTag": "SB"
}
```

## Download invoice

Method returns [Psr\Http\Message\ResponseInterface](https://www.php-fig.org/psr/psr-7/).

```php
use MpApiClient\Common\Interfaces\FinancialClientInterface;

/** @var FinancialClientInterface $financialClient */
$response = $financialClient->downloadInvoice('invoice-id');

header('Content-Type: ' . $response->getHeaderLine('Content-Type'));
echo $response->getBody()->getContents();
```

Example above displays invoice attachment in a browser.

## Get list of all offsets

Method returns [OffsetList](../src/Financial/Entity/Offset/OffsetList.php) containing [Offset](../src/Financial/Entity/Offset/Offset.php) entity.

```php
use MpApiClient\Common\Interfaces\FinancialClientInterface;

/** @var FinancialClientInterface $financialClient */
$labels = $financialClient->listOffsets(null);
echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "paging": {
    "total": 1,
    "pages": 1,
    "size": 1,
    "page": 1
  },
  "data": [
    {
      "partner": "3000",
      "documentNumber": "0000003000-28032019",
      "createdAt": "2019-03-28 00:00:00",
      "dueDate": "2018-12-07 00:00:00",
      "currency": "CZK",
      "diffPrice": -2550.91,
      "variableSymbol": 3003190328,
      "supplier": {
        "name": "VIVANTIS a.s.",
        ...
        "address": {
          "street": "Školní náměstí 14",
          "city": "Chrudim",
          "zip": "537 01",
          "country": "CZ"
        }
      },
      "customer": {
        "name": "Internet Mall, a.s.",
        ...
        "address": {
          "street": "U garáží 1611\/1",
          "city": "Praha 7 - Holešovice",
          "zip": "170 00",
          "country": "CZ"
        }
      },
      "invoices": [
        {
          "id": 3003000034,
          ...
        }
      ],
      "orders": [
        {
          "id": 10016693501,
          ...
        }
      ],
      "attachment": {
        "filename": "MP_offset_0000003000-28032019.PDF",
        "mime": "application\/pdf"
      }
    }
  ]
}
```

## Get offset detail

Method returns [Offset](../src/Financial/Entity/Offset/Offset.php) entity.

```php
use MpApiClient\Common\Interfaces\FinancialClientInterface;

/** @var FinancialClientInterface $financialClient */
$labels = $financialClient->getOffset('offset-id');
echo json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
{
  "partner": "3000",
  "documentNumber": "0000003000-28032019",
  "createdAt": "2019-03-28 00:00:00",
  "dueDate": "2018-12-07 00:00:00",
  "currency": "CZK",
  "diffPrice": -2550.91,
  "variableSymbol": 3003190328,
  "supplier": {
    "name": "VIVANTIS a.s.",
    ...
    "address": {
      "street": "Školní náměstí 14",
      "city": "Chrudim",
      "zip": "537 01",
      "country": "CZ"
    }
  },
  "customer": {
    "name": "Internet Mall, a.s.",
    ...
    "address": {
      "street": "U garáží 1611\/1",
      "city": "Praha 7 - Holešovice",
      "zip": "170 00",
      "country": "CZ"
    }
  },
  "invoices": [
    {
      "id": 3003000034,
      ...
    }
  ],
  "orders": [
    {
      "id": 10016693501,
      ...
    }
  ],
  "attachment": {
    "filename": "MP_offset_0000003000-28032019.PDF",
    "mime": "application\/pdf"
  }
}
```

## Download offset attachment

Method returns [Psr\Http\Message\ResponseInterface](https://www.php-fig.org/psr/psr-7/).

```php
use MpApiClient\Common\Interfaces\FinancialClientInterface;

/** @var FinancialClientInterface $financialClient */
$response = $financialClient->downloadOffset('offset-id');

header('Content-Type: ' . $response->getHeaderLine('Content-Type'));
echo $response->getBody()->getContents();
```

Example above displays offset attachment in a browser.

### See more examples [here](../example/Financial.php)
