<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class PricingLevelBadTypeException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	protected $message = 'Bad pricing level type: "%s". Accepted values are "%s".';

	/**
	 *
	 * @param string $currentStatus
	 * @param array $allowed
	 */
	public function __construct($currentStatus, array $allowed)
	{
		$this->message = sprintf($this->message, $currentStatus, implode('" and "', $allowed));
		parent::__construct($this->message);
	}
}
