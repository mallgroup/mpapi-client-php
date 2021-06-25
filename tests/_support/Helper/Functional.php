<?php declare(strict_types=1);

namespace MpApiClient\Tests\_support\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module;
use Exception;
use GuzzleHttp\Client;
use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Common\DTO\Paging;
use MpApiClient\Common\Interfaces\AuthMiddlewareInterface;
use MpApiClient\Common\Util\AbstractList;
use MpApiClient\Filter\Filter;
use MpApiClient\MpApiClientOptions;

final class Functional extends Module
{

    /**
     * @var string[]
     */
    protected $requiredFields = ['base_uri', 'client_id'];

    /**
     * @var array<string, mixed>
     */
    protected $config = [
        'timeout'         => 20,
        'allow_redirects' => true,
    ];

    private string $staticRandomString;

    public static function getRandomString(int $length = 10): string
    {
        try {
            return bin2hex(random_bytes($length));
        } catch (Exception $e) {
            // just a simple fallback, but should never be needed
            $max = 10 ^ $length;

            return (string) mt_rand($max / 10, $max - 1);
        }
    }

    public static function getRandomInt(int $length = 10): int
    {
        $min = (10 ^ $length) / 10;
        $max = 10 ^ $length - 1;

        try {
            return random_int($min, $max);
        } catch (Exception $e) {
            // just a simple fallback, but should never be needed
            return mt_rand($min, $max);
        }
    }

    /**
     * @param array<string, mixed> $settings
     */
    public function _beforeSuite($settings = []): void
    {
        $this->staticRandomString = $this->getRandomString();
    }

    public function getAuthenticator(): AuthMiddlewareInterface
    {
        return new ClientIdAuthenticator($this->config['client_id']);
    }

    public function getGuzzleClient(): Client
    {
        $options = new MpApiClientOptions($this->getAuthenticator());
        $options->setBaseUri($this->config['base_uri']);
        $options->setTimeout($this->config['timeout']);
        $options->setAllowRedirects($this->config['allow_redirects']);

        return new Client($options->getGuzzleOptionsArray());
    }

    public function getStaticRandomString(): string
    {
        return $this->staticRandomString;
    }

    /**
     * Generic helper function, to assert correct paging was returned
     */
    public function assertPaging(AbstractList $list, Filter $filter): void
    {
        $page = (int) (floor($filter->getOffset() / $filter->getLimit()) + 1);

        $this->assertInstanceOf(Paging::class, $list->getPaging());
        $this->assertGreaterOrEquals($page, $list->getPaging()->getPage());
        $this->assertLessThanOrEqual($filter->getLimit(), $list->getPaging()->getSize()); // LTE because if the total is less than max, size = total, not max size
        $this->assertGreaterThanOrEqual(0, $list->getPaging()->getTotal());
        $this->assertGreaterThanOrEqual(1, $list->getPaging()->getPages());
    }

}
