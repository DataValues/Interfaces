<?php

declare( strict_types = 1 );

namespace ValueFormatters;

use Exception;

/**
 * @since 1.1.1
 *
 * @license GPL-2.0-or-later
 * @author Arthur Taylor
 */
class MismatchingOptionTypeException extends \InvalidArgumentException {

	/**
	 * @var string
	 */
	private $expectedType;

	/**
	 * @var string
	 */
	private $optionType;

	/**
	 * @param string $expectedType
	 * @param string $optionType
	 * @param string $message
	 * @param Exception|null $previous
	 */
	public function __construct(
		$expectedType,
		$optionType,
		$message = '',
		Exception $previous = null
	) {
		$this->expectedType = $expectedType;
		$this->optionType = $optionType;

		if ( $message === '' ) {
			$message = 'Option type "' . $optionType . '" does not match expected "'
				. $expectedType . '"';
		}

		parent::__construct( $message, 0, $previous );
	}

	/**
	 * @return string
	 */
	public function getExpectedType() {
		return $this->expectedType;
	}

	/**
	 * @return string
	 */
	public function getOptionType() {
		return $this->optionType;
	}

}
