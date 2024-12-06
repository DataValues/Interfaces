<?php

declare( strict_types = 1 );

namespace ValueParsers\Tests;

use PHPUnit\Framework\TestCase;
use ValueParsers\ParserOptions;

/**
 * @covers \ValueParsers\ParserOptions
 *
 * @group ValueParsers
 * @group DataValueExtensions
 *
 * @license GPL-2.0-or-later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ParserOptionsTest extends TestCase {

	public function testConstructor() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			'baz' => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$parserOptions = new ParserOptions( $options );

		foreach ( $options as $option => $value ) {
			$this->assertSame(
				serialize( $value ),
				serialize( $parserOptions->getOption( $option ) ),
				'Option should be set properly'
			);
		}

		$this->assertFalse( $parserOptions->hasOption( 'ohi' ) );
	}

	public function testConstructorFail() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			42 => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$this->expectException( \Exception::class );

		new ParserOptions( $options );
	}

	public function setOptionProvider() {
		$argLists = [];

		$parserOptions = new ParserOptions();

		$argLists[] = [ $parserOptions, 'foo', 42 ];
		$argLists[] = [ $parserOptions, 'bar', 42 ];
		$argLists[] = [ $parserOptions, 'foo', 'foo' ];
		$argLists[] = [ $parserOptions, 'foo', null ];

		return $argLists;
	}

	/**
	 * @dataProvider setOptionProvider
	 */
	public function testSetAndGetOption( ParserOptions $options, $option, $value ) {
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

		$parserOptions = new ParserOptions( $options );

		foreach ( array_keys( $options ) as $option ) {
			$this->assertTrue( $parserOptions->hasOption( $option ) );
		}

		$this->assertFalse( $parserOptions->hasOption( 'ohi' ) );
		$this->assertFalse( $parserOptions->hasOption( 'Foo' ) );
	}

	public function testSetOption() {
		$parserOptions = new ParserOptions( [ 'foo' => 'bar' ] );

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
			$parserOptions->setOption( $value[0], $value[1] );
			$this->assertSame( $value[1], $parserOptions->getOption( $value[0] ) );
		}
	}

	/**
	 * @dataProvider nonExistingOptionsProvider
	 */
	public function testGetOption( $nonExistingOption ) {
		$this->assertTrue( true );
		$parserOptions = new ParserOptions( [ 'foo' => 'bar' ] );

		$this->expectException( 'InvalidArgumentException' );

		$parserOptions->getOption( $nonExistingOption );
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

		$parserOptions = new ParserOptions( $options );

		foreach ( array_keys( $options ) as $option ) {
			$parserOptions->requireOption( $option );
		}

		$this->expectException( 'Exception' );

		$parserOptions->requireOption( 'Foo' );
	}

	public function testDefaultOption() {
		$options = [
			'foo' => 42,
			'bar' => 4.2,
			'baz' => [ 'o_O', false, null, '42' => 42, [] ]
		];

		$parserOptions = new ParserOptions( $options );

		foreach ( $options as $option => $value ) {
			$parserOptions->defaultOption( $option, 9001 );

			$this->assertSame(
				serialize( $value ),
				serialize( $parserOptions->getOption( $option ) ),
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
			$parserOptions->defaultOption( $option, $value );

			$this->assertSame(
				serialize( $value ),
				serialize( $parserOptions->getOption( $option ) ),
				'Defaulting a not set option should affect its value'
			);
		}
	}

	public function testWithDefaultOption() {
		$originalOptions = new ParserOptions( [ 'foo' => 'foo' ] );

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
