<?php

if ( defined( 'DataValuesInterfaces_VERSION' ) ) {
	// Do not initialize more then once.
	return;
}

define( 'DataValuesInterfaces_VERSION', '0.1 alpha' );

// If one of the dependencies has not been loaded yet, attempt to include the Composer autoloader.
if ( !defined( 'DataValues_VERSION' ) && is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

// Attempt to include the DataValues lib if that hasn't been done yet.
// This is the path the DataValues entry point will be at when loaded as MediaWiki extension.
if ( !defined( 'DataValues_VERSION' ) && is_readable( __DIR__ . '/../DataValues/DataValues.php' ) ) {
	include_once( __DIR__ . '/../DataValues/DataValues.php' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'DataValues_VERSION' ) ) {
	throw new Exception( 'You need to have the DataValues library loaded in order to use DataValuesInterfaces' );
}

// @codeCoverageIgnoreStart
spl_autoload_register( function ( $className ) {
	static $classes = false;

	if ( $classes === false ) {
		$classes = include( __DIR__ . '/' . 'DataValuesInterfaces.classes.php' );
	}

	if ( array_key_exists( $className, $classes ) ) {
		include_once __DIR__ . '/' . $classes[$className];
	}
} );
// @codeCoverageIgnoreEnd
