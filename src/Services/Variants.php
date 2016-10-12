<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\VariantsEndpoints;
use MPAPI\Entity\Variant;
use MPAPI\Entity\AbstractEntity;
use MPAPI\Exceptions\ApplicationException;
use MPAPI\Exceptions\EndpointNotfoundException;
use MPAPI\Exceptions\EndpointNotContainMethod;

/**
 * Products service
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class Variants extends AbstractService
{

    /**
     *
     * @var string
     */
    const ENDPOINT_NAME_PATTERN = 'MPAPI\Endpoints\%sEndpoints';

    /**
     *
     * @var Client
     */
    private $client;

    /**
     *
     * @var VariantsEndpoints
     */
    private $variantsEndpoints;

    /**
     *
     * @var Variant[]
     */
    protected $entities = [];

    /**
     * Products constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->variantsEndpoints = new VariantsEndpoints($this->client);
    }

    /**
     * Get data
     *
     * @param string $productId
	 * @param string $variantId
     * @return Product|array|null
     */
    public function get($productId, $variantId = null)
    {
        $retval = null;
        if (is_null($variantId)) {
            $response = $this->variantsEndpoints->getVariants($productId);
            $retval = json_decode($response->getBody(), true)['data'];
        } else {
            $response = $this->variantsEndpoints->getDetail($productId);
            $retval = new Variant(json_decode($response->getBody(), true)['data']);
        }

        return $retval;
    }

    /**
     * Delete data
     *
     * @param string $productId
	 * @param string $variantId
     * @return Response
     */
    public function delete($productId, $variantId)
    {
        $errors = [];
        if (empty($productId) && !empty($this->entities)) {
            foreach ($this->entities as $index => $productEntity) {
                $response = $this->variantsEndpoints->deleteProduct($productEntity->getId());
                unset($this->entities[$index]);
                if ($response->getStatusCode() !== 204) {
                    $errors[$index] = [
                        'entity' => $productEntity->getData(),
                        'response' => json_decode($response->getBody(), true)
                    ];
                }
            }
        } else {
            $response = $this->variantsEndpoints->deleteProduct($productId);
            if ($response->getStatusCode() !== 204) {
                $errors[] = [
                    'response' => json_decode($response->getBody(), true)
                ];
            }
        }

        if (!empty($errors)) {
            $this->client->getLogger()->error('Error during post products', $errors);
            $exception = new ApplicationException();
            $exception->setData($errors);
            throw $exception;
        }

        return true;
    }

    /**
     * Post data
     *
	 * @param string $productId
     * @param array|Variant $data
     * @return Response
     */
    public function post($productId, $data = null)
    {
        $errors = [];
        if (empty($data) && !empty($this->entities)) {
            foreach ($this->entities as $index => $productEntity) {
                $response = $this->variantsEndpoints->postProduct($productEntity->getData());
                unset($this->entities[$index]);
                if ($response->getStatusCode() !== 201) {
                    $errors[$index] = [
                        'entity' => $productEntity->getData(),
                        'response' => json_decode($response->getBody(), true)
                    ];
                }
            }
        } else {
            if ($data instanceof Variant) {
                $data = $data->getData();
            }
            $response = $this->variantsEndpoints->postProduct($data);
            if (json_decode($response->getBody(), true) == null) {
                $errors[] = (string)$response->getBody();
            }
        }

        if (!empty($errors)) {
            $this->client->getLogger()->error('Error during post products', $errors);
            $exception = new ApplicationException('Error during post products: ' . implode(', ', $errors));
            throw $exception;
        }

        return true;
    }

    /**
     * Put data
     *
     * @param string $productId
	 * @param string $variantId
     * @param AbstractEntity $entity
     * @return Response
     */
    public function put($productId, $variantId = null, AbstractEntity $entity = null)
    {
        if ($entity !== null) {
            list ($endpoint, $method) = $this->getEndpoint($entity, __METHOD__);
        }

        $errors = [];
        if (empty($entity) && !empty($this->entities)) {
            foreach ($this->entities as $index => $productEntity) {
                list ($endpoint, $method) = $this->getEndpoint($productEntity, __METHOD__);
                $response = $endpoint->$method($productEntity->getId(), $productEntity->getData());
                unset($this->entities[$index]);
                if ($response->getStatusCode() !== 200) {
                    $errors[$index] = [
                        'entity' => $productEntity->getData(),
                        'response' => json_decode($response->getBody(), true)
                    ];
                }
            }
        } else {
            $response = $endpoint->$method($productId, $entity->getData(), $variantId);
        }

        if (!empty($errors)) {
            $this->client->getLogger()->error('Error during post products', $errors);
            $exception = new ApplicationException();
            $exception->setData($errors);
            throw $exception;
        }

        return true;
    }

    /**
     * Add variant for batch operation
     *
     * @see \MPAPI\Services\AbstractService::add()
     */
    public function add(AbstractEntity $entity)
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * Get base class name
     *
     * @param object $object
     * @return string
     */
    private function getClassBasename($object)
    {
        $className = get_class($object);
        return (substr($className, strrpos($className, '\\') + 1));
    }

    /**
     * Get base method name
     *
     * @param string $methodName
     * @return string
     */
    private function getMethodBasename($methodName)
    {
        return (substr($methodName, strrpos($methodName, ':') + 1));
    }

    /**
     * Get endpoint for specific entity
     *
     * @param AbstractEntity $entity
     * @throws \Exception
     * @return Object
     */
    private function getEndpoint(AbstractEntity $entity, $method)
    {
        $classBasename = $this->getClassBasename($entity);
        $endpointClass = sprintf(self::ENDPOINT_NAME_PATTERN, $classBasename);
        $methodName = $this->getMethodBasename($method) . $classBasename;
        if (!class_exists($endpointClass)) {
            throw new EndpointNotfoundException($classBasename);
        }

        $endpoint = new $endpointClass($this->client);
        if (!method_exists($endpoint, $methodName)) {
            throw new EndpointNotContainMethod($classBasename, $methodName);
        }
        return [
            $endpoint,
            $methodName
        ];
    }
}
