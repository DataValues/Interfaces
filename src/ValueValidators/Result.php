<?php

declare( strict_types = 1 );

namespace ValueValidators;

/**
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
final class Result {

	private $isValid;
	private $errors;

	/**
	 * @return self
	 */
	public static function newSuccess(): self {
		return new static( true );
	}

	/**
	 * @param Error[] $errors
	 *
	 * @return self
	 */
	public static function newError( array $errors ): self {
		return new static( false, $errors );
	}

	/**
	 * Returns a result that represents the combination of the two given results.
	 * In particular, this means:
	 *
	 * If $a->getErrors() is empty and $a->isValid() is true, $b is returned.
	 * If $b->getErrors() is empty and $b->isValid() is true, $a is returned.
	 *
	 * Otherwise, a new Result is constructed that contains
	 * all errors from $a and $b, and is considered valid
	 * if both $a and $b were valid.
	 *
	 * @param self $a
	 * @param self $b
	 *
	 * @return self
	 */
	public static function merge( self $a, self $b ): self {
		$aErrors = $a->getErrors();
		$bErrors = $b->getErrors();

		if ( $a->isValid() && empty( $aErrors ) ) {
			return $b;
		} elseif ( $b->isValid() && empty( $bErrors ) ) {
			return $a;
		} else {
			$errors = array_merge( $aErrors, $bErrors );
			$valid = ( $a->isValid() && $b->isValid() );

			return new self( $valid, $errors );
		}
	}

	/**
	 * @param bool $isValid
	 * @param Error[] $errors
	 */
	protected function __construct( bool $isValid, array $errors = [] ) {
		$this->isValid = $isValid;
		$this->errors = $errors;
	}

	public function isValid(): bool {
		return $this->isValid;
	}

	/**
	 * Returns an array with the errors that occurred during validation.
	 *
	 * @return Error[]
	 */
	public function getErrors(): array {
		return $this->errors;
	}

}
