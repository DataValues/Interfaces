<?php

declare( strict_types = 1 );

namespace ValueValidators;

/**
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Error {

	public const SEVERITY_ERROR = 9;
	public const SEVERITY_WARNING = 4;

	private $text;
	private $severity;
	private $property;

	private $code;
	private $params;

	public static function newError( string $text = '', string $property = null, string $code = 'invalid', array $params = [] ): self {
		return new self( $text, self::SEVERITY_ERROR, $property, $code, $params );
	}

	protected function __construct( string $text, int $severity, ?string $property, string $code, array $params ) {
		$this->text = $text;
		$this->severity = $severity;
		$this->property = $property;
		$this->code = $code;
		$this->params = $params;
	}

	public function getText(): string {
		return $this->text;
	}

	/**
	 * @return integer, element of the ValueValidatorError::SEVERITY_ enum
	 */
	public function getSeverity(): int {
		return $this->severity;
	}

	/**
	 * Returns the property of the value for which the error occurred, or null if it occurred for the value itself.
	 */
	public function getProperty(): ?string {
		return $this->property;
	}

	public function getParameters(): array {
		return $this->params;
	}

	public function getCode(): string {
		return $this->code;
	}

}
