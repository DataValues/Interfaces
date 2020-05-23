<?php

declare( strict_types = 1 );

namespace ValueValidators;

/**
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface ValueValidator {

	/**
	 * @param mixed $value The value to validate
	 *
	 * @return Result
	 */
	public function validate( $value );

}
