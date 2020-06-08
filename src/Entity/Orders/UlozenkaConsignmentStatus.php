<?php

namespace MPAPI\Entity\Orders;

use DateTime;
use DateTimeInterface;
use Exception;

/**
 * Class UlozenkaConsignmentStatus
 * @package Marketplace\Entity\Orders
 * @author  Michal Saloň <michal.salon@mallgroup.com>
 */
final class UlozenkaConsignmentStatus
{

	const DATE_TIME_FORMAT = 'd.m.Y H:i:s';

	/** @var int */
	private $id;

	/** @var string */
	private $name;

	/** @var DateTimeInterface */
	private $date;

	/**
	 * UlozenkaConsignmentStatus constructor.
	 * @param int               $id
	 * @param string            $name
	 * @param DateTimeInterface $date
	 */
	public function __construct($id, $name, DateTimeInterface $date)
	{
		$this->id = (int) $id;
		$this->name = $name;
		$this->date = $date;
	}

	/**
	 * @param array $data
	 * @return $this
	 * @throws Exception
	 */
	public static function createFromArray(array $data)
	{
		return new self(
			(int) $data['id'],
			$data['name'],
			new DateTime($data['date'])
		);
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return [
			'id'   => $this->getId(),
			'name' => $this->getName(),
			'date' => $this->getDate()->format(self::DATE_TIME_FORMAT),
		];
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return DateTimeInterface
	 */
	public function getDate()
	{
		return $this->date;
	}

}
