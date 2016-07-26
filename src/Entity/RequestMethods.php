<?php
namespace MPAPI\Entity;

/**
 * List of request methods
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
abstract class RequestMethods
{
	/**
	 *
	 * @var string
	 */
	const POST = 'POST';

	/**
	 *
	 * @var string
	 */
	const PUT = 'PUT';

	/**
	 *
	 * @var string
	 */
	const GET = 'GET';

	/**
	 *
	 * @var string
	 */
	const DELETE = 'DELETE';

	/**
	 *
	 * @var string
	 */
	const PATCH = 'PATCH';

	/**
	 *
	 * @var string
	 */
	const HEAD = 'HEAD';

	/**
	 *
	 * @var string
	 */
	const OPTIONS = 'OPTIONS';
}