# Exceptions

Client contains custom exceptions, for easier error handling in your application.

All custom exceptions extend generic `MpApiException`.

Some methods might throw other native PHP exceptions (i.e., `InvalidArgumentException`), which do not extend `MpApiException`. Such methods always have
appropriate `@throws` tags.

## [MpApiException](../src/Exception/MpApiException.php)

- Generic exception which almost all exceptions thrown in this client extend

## [IncorrectDataTypeException](../src/Exception/IncorrectDataTypeException.php)

- Thrown when method called expects data of a specific type, but received a different one

## [BadResponseException](../src/Exception/BadResponseException.php)

- Thrown when API responded with 4xx or 5xx status code that could not be translated to more specific exceptions
- Usually indicates an unknown/unexpected error occurred

## [NotFoundException](../src/Exception/NotFoundException.php)

- Thrown when API returns 404 status code
- This exception should never be thrown for endpoints with static url (i.e., lists)

## [UnauthorizedException](../src/Exception/UnauthorizedException.php)

- Thrown when API returns 401 status code
- Reasons might include
    - you forgot to provide authenticator middleware
    - you provided invalid credentials to authenticator middleware
    - disabled user account

## [TooManyRequestsException](../src/Exception/TooManyRequestsException.php)

- Thrown when API returns 429 status code
- In that case, you have been rate limited by the API and should slow down your request rate
- API returns rate limit information as part of response headers, which you can easily check

### Example of handling some errors

```php
<?php declare(strict_types=1);

use MpApiClient\Common\Interfaces\ChecksClientInterface;use MpApiClient\Exception\BadResponseException;
use MpApiClient\Exception\IncorrectDataTypeException;
use MpApiClient\Exception\MpApiException;
use MpApiClient\Exception\TooManyRequestsException;

try {
    /** @var ChecksClientInterface $checksClient */
    $brands = $checksClient->getDeliveryErrors();
} catch (TooManyRequestsException $e) {
    var_dump($e->getResponse()->getHeaders());
} catch (BadResponseException $e) {
    var_dump($e->getErrorCodes());
} catch (IncorrectDataTypeException $e) {
    var_dump('Incorrect type: ' . $e->getMessage());
} catch (MpApiException $e) {
    var_dump('Generic exception: ' . $e->getMessage());
}
```

### See more examples [here](../example/Exception.php)
