<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Martin Hrdlicka <jan.blaha@mall.cz>
 */
class PricingLevelBadTypeException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	protected $message = 'Bad pricing level type "%s" allowed are %s.';

	/**
	 *
	 * @param string $currentStatus
	 * @param array $allowed
	 */
	public function __construct($currentStatus, array $allowed)
	{
		$this->message = sprintf($this->message, $currentStatus, implode(', ', $allowed));
		parent::__construct($this->message);
	}
}
