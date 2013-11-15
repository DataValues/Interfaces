<?php

if ( defined( 'DataValuesInterfaces_VERSION' ) ) {
	// Do not initialize more then once.
	return;
}

define( 'DATAVALUES_INTERFACES_VERSION', '0.1 alpha' );

/**
 * @deprecated
 */
define( 'DataValuesInterfaces_VERSION', DATAVALUES_INTERFACES_VERSION );

// If one of the dependencies has not been loaded yet, attempt to include the Composer autoloader.
if ( !defined( 'DATAVALUES_VERSION' ) && is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

// Attempt to include the DataValues lib if that hasn't been done yet.
// This is the path the DataValues entry point will be at when loaded as MediaWiki extension.
if ( !defined( 'DATAVALUES_VERSION' ) && is_readable( __DIR__ . '/../DataValues/DataValues.php' ) ) {
	include_once( __DIR__ . '/../DataValues/DataValues.php' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'DATAVALUES_VERSION' ) ) {
	throw new Exception( 'You need to have the DataValues library loaded in order to use DataValuesInterfaces' );
}

// @codeCoverageIgnoreStart
spl_autoload_register( function ( $className ) {
	$className = ltrim( $className, '\\' );

	static $classes = false;

	if ( $classes === false ) {
		$classes = include( __DIR__ . '/' . 'DataValuesInterfaces.classes.php' );
	}

	if ( array_key_exists( $className, $classes ) ) {
		include_once __DIR__ . '/' . $classes[$className];
	}
} );

if ( defined( 'MEDIAWIKI' ) ) {
	$GLOBALS['wgExtensionCredits']['datavalues'][] = array(
		'path' => __DIR__,
		'name' => 'DataValuesInterfaces',
		'version' => DATAVALUES_INTERFACES_VERSION,
		'author' => array(
			'[https://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw]',
		),
		'url' => 'https://github.com/wikimedia/mediawiki-extensions-DataValuesInterfaces',
		'description' => 'Defines interfaces for ValueParsers, ValueFormatters and ValueValidators',
	);
}
// @codeCoverageIgnoreEnd
