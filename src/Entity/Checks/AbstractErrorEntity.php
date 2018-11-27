<?php

namespace MPAPI\Entity\Checks;

use MPAPI\Entity\AbstractEntity;

abstract class AbstractErrorEntity extends AbstractEntity
{
	/**
	 * @var string
	 */
	const KEY_MSG = 'msg';

	/**
	 * @var string
	 */
	const KEY_CODE = 'code';

	/**
	 * @var string
	 */
	const KEY_VALUE = 'value';

	/**
	 * @var string
	 */
	const KEY_ATTRIBUTE = 'attribute';

	/**
	 * @var string
	 */
	const KEY_ARTICLES = 'articles';

	/**
	 * @return string
	 */
	public function getMessage()
	{
		if (isset($this->data[self::KEY_MSG])) {
			return $this->data[self::KEY_MSG];
		}
		return '';
	}

	/**
	 * @return string
	 */
	public function getCode(){
		if (isset($this->data[self::KEY_CODE])) {
			return $this->data[self::KEY_CODE];
		}
		return '';
	}

	/**
	 * @return string
	 */
	public function getValue(){
		if (isset($this->data[self::KEY_VALUE])) {
			return $this->data[self::KEY_VALUE];
		}
		return '';
	}

	/**
	 * @return string
	 */
	public function getAttribute(){
		if (isset($this->data[self::KEY_ATTRIBUTE])) {
			return $this->data[self::KEY_ATTRIBUTE];
		}
		return '';
	}

	/**
	 * @return array
	 */
	public function getArticles(){
		if (isset($this->data[self::KEY_ARTICLES]) && is_array($this->data[self::KEY_ARTICLES])) {
			return $this->data[self::KEY_ARTICLES];
		}
		return [];
	}

	/**
	 * Get error data
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}
}
