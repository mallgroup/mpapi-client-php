<?php
namespace MPAPI\Lib\Handlers;

use Psr\Log\LoggerInterface;

/**
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ExceptionHandler
{
	/**
	 *
	 * @var LoggerInterface
	 */
	private $logger;

	/**
	 *
	 * @param LoggerInterface $logger
	 */
	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	/**
	 *
	 * @param \Exception $exception
	 * @return ExceptionHandler
	 */
	public function __invoke($exception)
	{
		$this->logger->error($exception->getMessage());
		print($exception->getMessage() . PHP_EOL);
		return $this;
	}
}