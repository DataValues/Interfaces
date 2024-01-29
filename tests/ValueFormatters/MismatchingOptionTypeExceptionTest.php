<?php

declare( strict_types = 1 );

namespace ValueFormatters;

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * @covers \ValueFormatters\MismatchingOptionTypeException
 *
 * @group ValueFormatters
 * @group DataValueExtensions
 *
 * @license GPL-2.0-or-later
 * @author Arthur Taylor
 */
class MismatchingOptionTypeExceptionTest extends TestCase {

	/**
	 * @dataProvider constructorProvider
	 */
	public function testConstructorWithRequiredArguments( $expectedType, $actualType ) {
		$exception = new MismatchingOptionTypeException( $expectedType, $actualType );

		$this->assertSame( $expectedType, $exception->getExpectedType() );
		$this->assertSame( $actualType, $exception->getOptionType() );
		$this->assertSame(
			"Option type \"$actualType\" does not match expected \"$expectedType\"",
			$exception->getMessage()
		);
		$this->assertNull( $exception->getPrevious() );
	}

	/**
	 * @dataProvider constructorProvider
	 */
	public function testConstructorWithAllArguments( $expectedType, $actualType ) {
		$message = 'Onoez! an error!';
		$previous = new Exception( 'Onoez!' );

		$exception = new MismatchingOptionTypeException(
			$expectedType,
			$actualType,
			$message,
			$previous
		);

		$this->assertSame( $expectedType, $exception->getExpectedType() );
		$this->assertSame( $actualType, $exception->getOptionType() );
		$this->assertSame( $message, $exception->getMessage() );
		$this->assertSame( $previous, $exception->getPrevious() );
	}

	public function constructorProvider() {
		return [
			[ 'string', 'time' ],
			[ 'globecoordinate', 'string' ]
		];
	}

}
