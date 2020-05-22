<?php

declare( strict_types = 1 );

namespace ValueParsers;

use InvalidArgumentException;
use RuntimeException;

/**
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
final class ParserOptions {

	/**
	 * @var array
	 */
	private $options;

	/**
	 * @param array $options
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct( array $options = [] ) {
		foreach ( array_keys( $options ) as $option ) {
			if ( !is_string( $option ) ) {
				throw new InvalidArgumentException( 'Option names need to be strings.' );
			}
		}

		$this->options = $options;
	}

	/**
	 * Sets the value of the specified option.
	 *
	 * @param string $option
	 * @param mixed $value
	 *
	 * @throws InvalidArgumentException
	 */
	public function setOption( $option, $value ) {
		if ( !is_string( $option ) ) {
			throw new InvalidArgumentException( 'Option name needs to be a string.' );
		}

		$this->options[$option] = $value;
	}

	/**
	 * Returns the value of the specified option. If the option is not set,
	 * an InvalidArgumentException is thrown.
	 *
	 * @param string $option
	 *
	 * @throws InvalidArgumentException
	 * @return mixed
	 */
	public function getOption( string $option ) {
		if ( !array_key_exists( $option, $this->options ) ) {
			throw new InvalidArgumentException();
		}

		return $this->options[$option];
	}

	/**
	 * Returns if the specified option is set or not.
	 */
	public function hasOption( string $option ): bool {
		return array_key_exists( $option, $this->options );
	}

	/**
	 * Sets the value of an option to the provided default in case the option is not set yet.
	 *
	 * @param string $option
	 * @param mixed $default
	 */
	public function defaultOption( string $option, $default ) {
		if ( !$this->hasOption( $option ) ) {
			$this->setOption( $option, $default );
		}
	}

	/**
	 * Requires an option to be set.
	 * If it's not set, a RuntimeException is thrown.
	 *
	 * @param string $option
	 *
	 * @throws RuntimeException
	 */
	public function requireOption( string $option ) {
		if ( !$this->hasOption( $option ) ) {
			throw new RuntimeException( 'Required option "' . $option . '" is not set.' );
		}
	}

}
