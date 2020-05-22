<?php

declare( strict_types = 1 );

namespace ValueParsers;

use RuntimeException;

/**
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ParseException extends RuntimeException {

	/**
	 * @var string|null
	 */
	private $expectedFormat;

	/**
	 * @var string|null
	 */
	private $rawValue;

	/**
	 * @param string $message        A plain english message describing the error
	 * @param string|null $rawValue The raw value that failed to be parsed.
	 * @param string|null $expectedFormat An identifier for the format the raw value did not match
	 */
	public function __construct( string $message, string $rawValue = null, string $expectedFormat = null ) {
		parent::__construct( $message );
		$this->expectedFormat = $expectedFormat;
		$this->rawValue = $rawValue;
	}

	/**
	 * An identifier for the format the raw value did not match.
	 *
	 * This does not necessarily specify the exact format the throwing parser accepts.
	 * For example, a PositiveFloatParser might throw a ParseException with the
	 * expected format 'float' if the value does not even parse as a float, while
	 * in fact the parser would only accept positive floats. However, if the user
	 * enters a negative float, the parser must throw with a more specific format,
	 * i. e. 'positive-float'.
	 */
	public function getExpectedFormat(): ?string {
		return $this->expectedFormat;
	}

	/**
	 * The raw value which was not parsable.
	 *
	 * This is not necessarily the value an user entered, but the rawest value
	 * that's available at the throwing site.
	 */
	public function getRawValue(): ?string {
		return $this->rawValue;
	}

}
