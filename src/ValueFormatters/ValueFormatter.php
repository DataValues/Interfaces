<?php

declare( strict_types = 1 );

namespace ValueFormatters;

/**
 * Interface for value formatters, typically (but not limited to) expecting a DataValue object and
 * returning a string.
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface ValueFormatter {

	/**
	 * Identifier for the option that holds the code of the language in which the formatter should
	 * operate.
	 */
	const OPT_LANG = 'lang';

	/**
	 * @param mixed $value
	 *
	 * @return mixed
	 * @throws FormattingException
	 * @throws \InvalidArgumentException when value is of wrong type or out of accepted range/pattern
	 */
	public function format( $value );

}
