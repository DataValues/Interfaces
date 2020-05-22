<?php

namespace ValueValidators;

/**
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Error {

	const SEVERITY_ERROR = 9;
	const SEVERITY_WARNING = 4;

	protected $text;
	protected $severity;
	protected $property;

	protected $code;
	protected $params;

	/**
	 * @param string      $text
	 * @param string|null $property
	 * @param string      $code
	 * @param array       $params
	 *
	 * @return self
	 */
	public static function newError( $text = '', $property = null, $code = 'invalid', array $params = [] ) {
		return new static( $text, self::SEVERITY_ERROR, $property, $code, $params );
	}

	/**
	 * @param string      $text
	 * @param integer     $severity
	 * @param string|null $property
	 * @param string      $code
	 * @param array       $params
	 */
	protected function __construct( $text, $severity, $property, $code, array $params ) {
		$this->text = $text;
		$this->severity = $severity;
		$this->property = $property;
		$this->code = $code;
		$this->params = $params;
	}

	/**
	 * @return string
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * @return integer, element of the ValueValidatorError::SEVERITY_ enum
	 */
	public function getSeverity() {
		return $this->severity;
	}

	/**
	 * Returns the property of the value for which the error occurred, or null if it occurred for the value itself.
	 *
	 * @return string|null
	 */
	public function getProperty() {
		return $this->property;
	}

	/**
	 * @return array
	 */
	public function getParameters() {
		return $this->params;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

}
