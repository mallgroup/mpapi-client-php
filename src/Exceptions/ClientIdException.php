<?php
namespace MPAPI\Exceptions;

class ClientIdException extends \Exception
{
	/**
	 *
	 * @var string
	 */
	const MSG_CLIENT_ID_NOT_CONTAIN_ENVIRONMENT = 'Client id does not contain environment.';

	/**
	 *
	 * @var string
	 */
	const MSG_MISSING_CLIENT_ID = 'Missing client id';
}