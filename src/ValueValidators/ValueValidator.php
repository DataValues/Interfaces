<?php

namespace ValueValidators;

/**
 * Interface for value validators.
 *
 * @since 0.1
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface ValueValidator {

	/**
	 * Parses a value.
	 *
	 * @since 0.1
	 *
	 * @param mixed $value The value to validate
	 *
	 * @return Result
	 */
	public function validate( $value );

}
