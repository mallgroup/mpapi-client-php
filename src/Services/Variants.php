<?php
namespace MPAPI\Services;

use GuzzleHttp\Psr7\Response;
use MPAPI\Endpoints\Variants\VariantsGetEndpoints;
use MPAPI\Endpoints\Variants\VariantsPostEndpoints;
use MPAPI\Endpoints\Variants\VariantsPutEndpoints;
use MPAPI\Endpoints\Variants\VariantsDeleteEndpoints;
use MPAPI\Entity\Variant;
use MPAPI\Entity\AbstractEntity;
use MPAPI\Exceptions\ApplicationException;

/**
 * Variants service
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Variants extends AbstractService
{
	/**
	 *
	 * @var string
	 */
	const ENDPOINT_NAME_PATTERN = 'MPAPI\Endpoints\Variants\%sEndpoints';

	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var VariantsGetEndpoints
	 */
	private $variantsGetEndpoints;

	/**
	 *
	 * @var VariantsPostEndpoints
	 */
	private $variantsPostEndpoints;

	/**
	 *
	 * @var VariantsPutEndpoints
	 */
	private $variantsPutEndpoints;

	/**
	 *
	 * @var VariantsDeleteEndpoints
	 */
	private $variantsDeleteEndpoints;

	/**
	 * Variants constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->variantsGetEndpoints = new VariantsGetEndpoints($this->client);
		$this->variantsPostEndpoints = new VariantsPostEndpoints($this->client);
		$this->variantsPutEndpoints = new VariantsPutEndpoints($this->client);
		$this->variantsDeleteEndpoints = new VariantsDeleteEndpoints($this->client);
	}

	/**
	 * Get data
	 *
	 * @return VariantsGetEndpoints
	 */
	public function get()
	{
		return $this->variantsGetEndpoints;
	}

	/**
	 * Delete data
	 *
	 * @return VariantsDeleteEndpoints
	 */
	public function delete()
	{
		return $this->variantsDeleteEndpoints;
	}

	/**
	 * Post data
	 *
	 * @param string $productId
	 * @param array|Variant $data
	 * @return VariantsPostEndpoints
	 */
	public function post($productId, $data = null)
	{
		$errors = [];
		if ($data instanceof Variant) {
			$data = $data->getData();
		}
		// call API
		$response = $this->variantsPostEndpoints->create($productId, $data);

		if ($response->getStatusCode() !== 201) {
			$errors = [
				'entity' => $data,
				'response' => json_decode($response->getBody(), true)
			];
		}

		if (!empty($errors)) {
			$this->client->getLogger()->error('Error during post variants', $errors);
			$exception = new ApplicationException('Error during post variants ' . implode(', ', $errors));
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
	public function put()
	{
		return $this->variantsPutEndpoints;
	}
}
