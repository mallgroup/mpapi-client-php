<?php

namespace MPAPI\Lib\Helpers;

/**
 * Class InputDataHelper
 * @package MPAPI\Lib\Helpers
 * @author  Michal Saloň <michal.salon@mallgroup.com>
 */
final class InputDataHelper
{

	/**
	 * @param mixed[]  $data
	 * @param string[] $keys
	 * @return string
	 */
	public static function getString($data, $keys)
	{
		$result = self::getNullableKey($data, $keys);
		if ($result === null) {
			return '';
		}
		return (string) $result;
	}

	/**
	 * @param mixed[]  $data
	 * @param string[] $keys
	 * @return string
	 */
	public static function getInt($data, $keys)
	{
		$result = self::getNullableKey($data, $keys);
		if ($result === null) {
			return 0;
		}
		return (int) $result;
	}

	/**
	 * @param mixed[]  $data
	 * @param string[] $keys
	 * @return string
	 */
	public static function getFloat($data, $keys)
	{
		$result = self::getNullableKey($data, $keys);
		if ($result === null) {
			return (float) 0;
		}
		return (float) $result;
	}

	/**
	 * @param mixed[]  $data
	 * @param string[] $keys
	 * @return string|null
	 */
	public static function getNullableString($data, $keys)
	{
		$result = self::getNullableKey($data, $keys);
		if ($result === null) {
			return null;
		}
		return (string) $result;
	}

	/**
	 * @param mixed[]  $data
	 * @param string[] $keys
	 * @return int|null
	 */
	public static function getNullableInt($data, $keys)
	{
		$result = self::getNullableKey($data, $keys);
		if ($result === null) {
			return null;
		}
		return (int) $result;
	}

	/**
	 * @param mixed[]  $data
	 * @param string[] $keys
	 * @return mixed|null
	 */
	private static function getNullableKey($data, $keys)
	{
		foreach ($keys as $key) {
			if (!isset($data[$key])) {
				return null;
			}
			$data = $data[$key];
		}

		return $data;
	}

}
