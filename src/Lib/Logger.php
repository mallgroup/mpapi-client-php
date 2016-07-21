<?php
namespace MPAPI\Lib;

use Psr\Log\LoggerInterface;

/**
 * Default dummy logger
 *
 * @author Jonas Habr <jonas.habr@mall.cz>
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class Logger implements LoggerInterface
{

	/**
	 * @see \Psr\Log\LoggerInterface::emergency()
	 */
	public function emergency($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::alert()
	 */
	public function alert($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::critical()
	 */
	public function critical($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::error()
	 */
	public function error($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::warning()
	 */
	public function warning($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::notice()
	 */
	public function notice($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::info()
	 */
	public function info($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::debug()
	 */
	public function debug($message, array $context = array())
	{
	}

	/**
	 * @see \Psr\Log\LoggerInterface::log()
	 */
	public function log($level, $message, array $context = array())
	{
	}

}