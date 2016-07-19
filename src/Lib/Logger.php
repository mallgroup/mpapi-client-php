<?php
namespace MPAPI\Lib\Logger;

use Psr\Log\LogLevel;
use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;

/**
 * Default logger
 *
 * @author jonas.habr@mall.cz
 */
class Logger extends AbstractLogger
{

	/**
	 * (non-PHPdoc)
	 *
	 * @see \Psr\Log\LoggerInterface::log()
	 */
	public function log($level, $message, array $context = array())
	{
		if ($level) {
			switch ($level) {
				case LogLevel::EMERGENCY:
					$this->emergency($message, $context);
					break;
				case LogLevel::ALERT:
					$this->alert($message, $context);
					break;
				case LogLevel::CRITICAL:
					$this->critical($message, $context);
					break;
				case LogLevel::ERROR:
					$this->error($message, $context);
					break;
				case LogLevel::WARNING:
					$this->error($message, $context);
					break;
				case LogLevel::NOTICE:
					$this->notice($message, $context);
					break;
				case LogLevel::INFO:
					$this->info($message, $context);
					break;
				case LogLevel::DEBUG:
					$this->debug($message, $context);
					break;
			}
		} else {
			throw new InvalidArgumentException();
		}
	}
}