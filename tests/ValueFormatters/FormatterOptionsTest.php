<?php

declare( strict_types = 1 );

namespace ValueFormatters\Tests;

use PHPUnit\Framework\TestCase;
use ValueFormatters\FormatterOptions;

/**
 * @covers \ValueFormatters\FormatterOptions
 *
 * @group ValueFormatters
 * @group DataValueExtensions
 *
 * @license GPL-2.0-or-later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FormatterOptionsTest extends TestCase {

	public function testConstructor() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			'baz' => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$formatterOptions = new FormatterOptions( $options );

		foreach ( $options as $option => $value ) {
			$this->assertSame(
				serialize( $value ),
				serialize( $formatterOptions->getOption( $option ) ),
				'Option should be set properly'
			);
		}

		$this->assertFalse( $formatterOptions->hasOption( 'ohi' ) );
	}

	public function testConstructorFail() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			42 => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$this->expectException( \Exception::class );

		new FormatterOptions( $options );
	}

	public function setOptionProvider() {
		$argLists = [];

		$formatterOptions = new FormatterOptions();

		$argLists[] = [ $formatterOptions, 'foo', 42 ];
		$argLists[] = [ $formatterOptions, 'bar', 42 ];
		$argLists[] = [ $formatterOptions, 'foo', 'foo' ];
		$argLists[] = [ $formatterOptions, 'foo', null ];

		return $argLists;
	}

	/**
	 * @dataProvider setOptionProvider
	 */
	public function testSetAndGetOption( FormatterOptions $options, $option, $value ) {
		$options->setOption( $option, $value );

		$this->assertEquals(
			$value,
			$options->getOption( $option ),
			'Setting an option should work'
		);
	}

	public function testHashOption() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			'baz' => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$formatterOptions = new FormatterOptions( $options );

		foreach ( array_keys( $options ) as $option ) {
			$this->assertTrue( $formatterOptions->hasOption( $option ) );
		}

		$this->assertFalse( $formatterOptions->hasOption( 'ohi' ) );
		$this->assertFalse( $formatterOptions->hasOption( 'Foo' ) );
	}

	public function testSetOption() {
		$formatterOptions = new FormatterOptions( [ 'foo' => 'bar' ] );

		$values = [
			[ 'foo', 'baz' ],
			[ 'foo', 'bar' ],
			[ 'onoez', '' ],
			[ 'hax', 'zor' ],
			[ 'nyan', 9001 ],
			[ 'cat', 4.2 ],
			[ 'spam', [ '~=[,,_,,]:3' ] ],
		];

		foreach ( $values as $value ) {
			$formatterOptions->setOption( $value[0], $value[1] );
			$this->assertSame( $value[1], $formatterOptions->getOption( $value[0] ) );
		}
	}

	/**
	 * @dataProvider nonExistingOptionsProvider
	 */
	public function testGetOption( $nonExistingOption ) {
		$this->assertTrue( true );
		$formatterOptions = new FormatterOptions( [ 'foo' => 'bar' ] );

		$this->expectException( 'OutOfBoundsException' );

		$formatterOptions->getOption( $nonExistingOption );
	}

	public function nonExistingOptionsProvider() {
		$argLists = [];

		$argLists[] = [ 'bar' ];
		$argLists[] = [ 'Foo' ];
		$argLists[] = [ 'FOO' ];
		$argLists[] = [ 'spam' ];
		$argLists[] = [ 'onoez' ];

		return $argLists;
	}

	public function testRequireOption() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			'baz' => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$formatterOptions = new FormatterOptions( $options );

		foreach ( array_keys( $options ) as $option ) {
			$formatterOptions->requireOption( $option );
		}

		$this->expectException( 'Exception' );

		$formatterOptions->requireOption( 'Foo' );
	}

	public function testDefaultOption() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			'baz' => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$formatterOptions = new FormatterOptions( $options );

		foreach ( $options as $option => $value ) {
			$formatterOptions->defaultOption( $option, 9001 );

			$this->assertSame(
				serialize( $value ),
				serialize( $formatterOptions->getOption( $option ) ),
				'Defaulting a set option should not affect its value'
			);
		}

		$defaults = [
			'N' => 42,
			'y' => 4.2,
			'a' => false,
			'n' => [ '42' => 42, [ '' ] ]
		];

		foreach ( $defaults as $option => $value ) {
			$formatterOptions->defaultOption( $option, $value );

			$this->assertSame(
				serialize( $value ),
				serialize( $formatterOptions->getOption( $option ) ),
				'Defaulting a not set option should affect its value'
			);
		}
	}

	public function testWithDefaultOption() {
		$originalOptions = new FormatterOptions( [ 'foo' => 'foo' ] );

		$newOptions = $originalOptions
			->withDefaultOption( 'foo', 'FOO' )
			->withDefaultOption( 'bar', 'BAR' );

		$this->assertNotSame( $originalOptions, $newOptions,
			'should be a fresh instance' );
		$this->assertSame( 'foo', $originalOptions->getOption( 'foo' ),
			'original options should have same non-default option' );
		$this->assertFalse( $originalOptions->hasOption( 'bar' ),
			'original options should not have default option' );
		$this->assertSame( 'foo', $newOptions->getOption( 'foo' ),
			'new options should have same non-default option' );
		$this->assertSame( 'BAR', $newOptions->getOption( 'bar' ),
			'new options should have default option' );
	}

}
