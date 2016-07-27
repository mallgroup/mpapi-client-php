<?php
namespace MPAPI\Exceptions;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class AvailabilityBadInStockValueException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	protected $message = 'Bad value for availability in stock allowed is only integer.';
}
