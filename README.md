![License](https://img.shields.io/badge/license-Apache_2-blue)
![PHPStan](https://img.shields.io/badge/PHPStan-level%20Max-brightgreen.svg?style=flat&logo=php)
![Psalm](https://img.shields.io/badge/Psalm-level%202-brightgreen.svg?style=flat&logo=php)

# Mall Marketplace API Client

## Description

MPAPI client is a tool created to help Internet Mall, a. s. partners easily manage article catalogue, deliveries, orders etc. using Mall Marketplace API.

## Requirements
- `64bit` version of `PHP 7.4` or `PHP 8`
- Guzzle 7

## Installation

To install the client using [Composer](https://getcomposer.org/doc/00-intro.md) run following command in your repository

```console
composer require mallgroup/mpapi-client
```

## Implementation

### Info

Client consists of one main client and multiple, separate, domain clients.

The main client groups all domain clients under one object, for easier implementation, but every domain client can be initialized and used by itself.

Every client provides an interface that SHOULD be used as parameter types in code, instead of client classes themselves (e.g., use `MpApiClientInterface $client`
or `BrandsClientInterface $client` instead of `MpApiClient $client` or `BrandsClient $client`).

When initializing the client, you MUST provide

1. an authenticator implementing [AuthMiddlewareInterface](src/Common/Interfaces/AuthMiddlewareInterface.php)
    - currently, only [ClientIdAuthenticator](src/Common/Authenticators/ClientIdAuthenticator.php), which accepts `my-client-id`, is provided
    - in the future, new authenticators will be released (e.g., OAuth)
2. name of the app using the API
    - it is sent with every request to Mall API for easier request identification and debugging of reported issues
    - please provide a simple, yet meaningful name (e.g., `MyAppName CRM` or `MyAppName Order sync`), instead of a random string

### Examples

There are 2 main ways to initialize the client

### 1. Using [MpApiClient](src/MpApiClient.php) with default config

```php
<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

require 'vendor/autoload.php';

// 1. Initialize client options with request authenticator
$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);

// 2. Initialize MP API Client
$client = MpApiClient::createFromOptions('my-app-name', $options);

// 3. Get brand client
$brandClient = $client->brand();
```

### 2. Using [MpApiClient](src/MpApiClient.php) (or any other domain client) with custom http client

- every domain client can be initialized this way as a standalone client
- when initializing a custom http client, `handler` stack with `AuthMiddlewareInterface` MUST be provided!

```php
<?php declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use MpApiClient\Brand\BrandClient;
use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

require 'vendor/autoload.php';

// 1. Initialize request authenticator
$authenticator = new ClientIdAuthenticator('my-client-id');

// 2. Create custom Guzzle http client with authenticator middleware

// 2.1 Create CurlHandler stack and Guzzle http client manually
$handler      = new CurlHandler();
$handlerStack = HandlerStack::create($handler);
$handlerStack->push($authenticator->getHandler());

$httpClient = new Client(
    [
        'base_uri'        => 'https://mpapi.mallgroup.com/v1/',
        'timeout'         => 10,
        'allow_redirects' => true,
        'handler'         => $handlerStack,
    ]
);

// 2.2. Create Guzzle client using MpApiClientOptions object
$options = new MpApiClientOptions($authenticator);
$options->setTimeout(30);

$httpClient = new Client($options->getGuzzleOptionsArray());

// 3. Create MpApiClient and BrandClient using custom Guzzle client
$client      = new MpApiClient($httpClient, 'my-app-name')
$brandClient = new BrandClient($httpClient, 'my-app-name')
```

## Examples for all client domains

* [Article](doc/Article.md)
* [Brand](doc/Brand.md)
* [Category](doc/Category.md)
* [Checks](doc/Checks.md)
* [Financial](doc/Financial.md)
* [Label](doc/Label.md)
* [Order](doc/Order.md)
* [Shop](doc/Shop.md)
* [SupplyDelay](doc/SupplyDelay.md)

List of custom Exceptions thrown in this client can be found [here](doc/Exception.md)

## ⚠ Warning

- client does not include support for deprecated endpoints that will be changed, replaced or removed in the future (e.g., `/v1/deliveries` or `/v1/gifts`)

## ℹ Known missing or incomplete features

- [ ] Support for `/v2/transports` endpoints
