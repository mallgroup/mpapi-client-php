<?php
namespace MPAPI\Services;

use MPAPI\Entity\AbstractEntity;
use MPAPI\Entity\DeliveryMethod;
use MPAPI\Entity\DeliveryPricing;
use MPAPI\Entity\DeliverySetup;
use MPAPI\Exceptions\ApplicationException;

/**
 * Delivery settings
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class DeliveryMethods extends AbstractService
{
	/**
	 *
	 * @var Client
	 */
	private $client;

	/**
	 *
	 * @var string
	 */
	const PATH = 'delivery-settings';

	/**
	 *
	 * @var DeliveryMethod[]
	 */
	private $entities = [];

	/**
	 * Orders constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get delivery settings
	 *
	 * @return array
	 */
	public function get()
	{
		$retval = [];
		$response = $this->client->sendRequest(self::PATH, 'GET');
		$response = json_decode($response->getBody(), true)['data'];

		foreach ($response['delivery_methods'] as $deliveryMethodData) {
			$deliveryMethod = new DeliveryMethod($deliveryMethodData);
			foreach ($response[DeliveryMethod::KEY_SETUPS] as $deliverySetupData) {
				$deliverySetup = new DeliverySetup($deliverySetupData[DeliverySetup::KEY_ID]);
				foreach ($deliverySetupData[DeliverySetup::KEY_PRICING] as $deliveryPricing) {
					if ($deliveryMethod->getId() == $deliveryPricing[DeliverySetup::KEY_ID]) {
						$deliverySetup->addPricing(new DeliveryPricing($deliveryPricing));
					}
				}
				$deliveryMethod->addDeliverySetup($deliverySetup);
			}
			$retval[] = $deliveryMethod;
		}

		return $retval;
	}

	/**
	 * Put delivery settings
	 *
	 * @param array|DeliveryMethod $deliveryMethods
	 * @throws \Exception
	 * @return boolean
	 */
	public function put($deliveryMethods = null)
	{
		$errors = [];
		$sendval = [];
		if (empty($data) && !empty($this->entities)) {
			foreach ($this->entities as $index => $deliveryMethodEntity) {
				$sendval['delivery_methods'][] = $deliveryMethodEntity->getData();
				$sendval['delivery_setups'] = $deliveryMethodEntity->getDeliverySetupsData();
			}

			$response = $this->client->sendRequest(self::PATH, 'PUT', $sendval);
			unset($this->entities);
			if ($response->getStatusCode() !== 200) {
				$errors[] = [
					'entity' => $sendval,
					'response' => json_decode($response->getBody(), true)
				];
			}
		} else {
			$response = $this->client->sendRequest(self::PATH, 'PUT', $deliveryMethods);
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
	 * Add delivery method
	 *
	 * @see \MPAPI\Services\AbstractService::add()
	 * @param AbstractEntity $entity
	 * @return DeliveryMethods
	 */
	public function add(AbstractEntity $entity)
	{
		$this->entities[] = $entity;
		return $this;
	}
}
