<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class AvailabilityBadStatusException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	protected $message = 'Bad availability status "%s" allowed are %s.';

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
