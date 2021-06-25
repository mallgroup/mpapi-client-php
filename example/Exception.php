<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\BadResponseException;
use MpApiClient\Exception\ForbiddenException;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Exception\NotFoundException;
use MpApiClient\Exception\TooManyRequestsException;
use MpApiClient\Exception\UnauthorizedException;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

//
// Basic exception handling example
//

try {
    $orderList = $client->orders()->get(1234567890);
} catch (UnauthorizedException $e) {
    // You provided invalid client id, or forgot to provide authenticator middleware altogether
    echo 'API authorization failed with error: ' . $e->getMessage();
} catch (TooManyRequestsException $e) {
    // Too many requests were sent to API and you got rate limited

    // Current max limit of requests for window
    echo $e->getResponse()->getHeaderLine('X-RateLimit-Limit') . PHP_EOL;
    // Remaining amount of requests in the time window
    echo $e->getResponse()->getHeaderLine('X-RateLimit-Remaining') . PHP_EOL;
    // Amount of seconds before the rate limit window resets
    echo $e->getResponse()->getHeaderLine('X-RateLimit-Reset') . PHP_EOL;
} catch (NotFoundException $e) {
    echo 'Order with id 1234567890 does not exist.';
} catch (ForbiddenException $e) {
    echo 'Request to API endpoint was forbidden.';
} catch (BadResponseException $e) {
    echo 'Request failed with error: ' . $e->getMessage() . PHP_EOL;

    foreach ($e->getErrorCodes() as $errorCode) {
        echo 'Error message: ' . $errorCode->getMessage() . PHP_EOL;
        echo 'Error code: ' . $errorCode->getCode() . PHP_EOL;
        echo 'Error attributes: ' . print_r($errorCode->getAttributes(), true) . PHP_EOL;
        echo PHP_EOL;
    }

    // print response returned from API
    echo $e->getResponse()->getBody()->getContents();
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while loading order list: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Unexpected generic error occurred while loading order list: ' . $e->getMessage();
}
