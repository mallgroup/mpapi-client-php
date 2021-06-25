<?php declare(strict_types=1);

namespace MpApiClient\Common;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use MpApiClient\Common\Interfaces\ClientInterface;
use MpApiClient\Exception\ExceptionFactory;
use MpApiClient\Exception\MpApiException;
use MpApiClient\MpApiClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractMpApiClient implements ClientInterface
{

    protected GuzzleClientInterface $client;

    protected string $appTag;

    public function __construct(GuzzleClientInterface $client, string $appTag)
    {
        $this->client = $client;
        $this->appTag = $appTag;
    }

    /**
     * @return array<string, string>
     */
    protected function getAppHeaders(): array
    {
        return [
            'X-Application-Name'    => MpApiClient::APP_NAME,
            'X-Application-Version' => MpApiClient::APP_VERSION,
            'X-Application-Tag'     => $this->appTag,
        ];
    }

    /**
     * @param string               $url
     * @param array<string, mixed> $query
     * @param array<string, mixed> $headers
     * @return array
     * @throws MpApiException
     */
    protected function sendQueryRequest(string $url, array $query, array $headers = []): array
    {
        $url = sprintf('%s?%s', $url, http_build_query($query));

        return $this->sendJson('GET', $url, [], $headers);
    }

    /**
     * @param string               $method
     * @param string               $url
     * @param array                $content
     * @param array<string, mixed> $headers
     * @param array<string, mixed> $options
     * @return array
     * @throws MpApiException
     */
    protected function sendJson(string $method, string $url, array $content = [], array $headers = [], array $options = []): array
    {
        // Add correct JSON request headers and app headers to request
        $headers = array_merge(
            [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
            $this->getAppHeaders(),
            $headers,
        );

        $response = $this->send(
            new Request(
                $method,
                $url,
                $headers,
                (string) json_encode($content),
            ),
            $options
        );

        return json_decode($response->getBody()->getContents() ?: '{}', true);
    }

    /**
     * @param RequestInterface     $request
     * @param array<string, mixed> $options
     * @return ResponseInterface
     * @throws MpApiException
     */
    protected function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        try {
            return $this->client->send($request, $options);
        } catch (GuzzleException $e) {
            throw ExceptionFactory::fromGuzzleException($e);
        }
    }

}
