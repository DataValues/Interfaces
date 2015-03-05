<?php

namespace ValueFormatters\Test;

use LogicException;
use ValueFormatters\FormatterOptions;
use ValueFormatters\ValueFormatter;

/**
 * Base for unit tests for ValueFormatter implementing classes.
 *
 * @since 0.1
 *
 * @group ValueFormatters
 * @group DataValueExtensions
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
abstract class ValueFormatterTestBase extends \PHPUnit_Framework_TestCase {

	/**
	 * Returns a list with valid inputs and their associated formatting output.
	 *
	 * @since 0.1
	 *
	 * @return array[]
	 */
	public abstract function validProvider();

	/**
	 * @deprecated since 0.2, override the getInstance method instead.
	 *
	 * @return string
	 */
	protected function getFormatterClass() {
		throw new LogicException(
			'ValueFormatterTestBase subclasses either need to override getFormatterClass or getInstance'
		);
	}

	/**
	 * @since 0.1
	 * @todo Should become abstract when getFormatterClass is removed.
	 *
	 * @param FormatterOptions|null $options
	 *
	 * @return ValueFormatter
	 */
	protected function getInstance( FormatterOptions $options = null ) {
		$class = $this->getFormatterClass();
		return new $class( $options ?: new FormatterOptions() );
	}

	/**
	 * @dataProvider validProvider
	 *
	 * @since 0.1
	 *
	 * @param mixed $value
	 * @param mixed $expected
	 * @param FormatterOptions|null $options
	 * @param ValueFormatter|null $formatter
	 */
	public function testValidFormat( $value, $expected, FormatterOptions $options = null, ValueFormatter $formatter = null ) {
		if ( $formatter === null ) {
			$formatter = $this->getInstance( $options );
		}

		$this->assertEquals( $expected, $formatter->format( $value ) );
	}

}
