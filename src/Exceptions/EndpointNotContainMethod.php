<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class EndpointNotContainMethod extends \Exception
{
	/**
	 *
	 * @var string
	 */
	protected $message = 'Object %s does not contain method %s.';

	/**
	 *
	 * @param string $currentStatus
	 * @param array $allowed
	 */
	public function __construct($className, $methodName)
	{
		$this->message = sprintf($this->message, $className, $methodName);
		parent::__construct($this->message);
	}
}
