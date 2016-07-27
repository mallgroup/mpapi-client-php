<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class EndpointNotfoundException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	protected $message = 'Endpoint %s does not exist.';

	/**
	 *
	 * @param string $currentStatus
	 * @param array $allowed
	 */
	public function __construct($endpointName)
	{
		$this->message = sprintf($this->message, $endpointName);
		parent::__construct($this->message);
	}
}
