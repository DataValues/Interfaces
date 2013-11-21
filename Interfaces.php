<?php

/**
 * Entry point of the DataValues Interfaces library.
 *
 * @since 0.1
 * @codeCoverageIgnore
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

if ( defined( 'DataValuesInterfaces_VERSION' ) ) {
	// Do not initialize more then once.
	return 1;
}

define( 'DATAVALUES_INTERFACES_VERSION', '0.1.2' );

/**
 * @deprecated
 */
define( 'DataValuesInterfaces_VERSION', DATAVALUES_INTERFACES_VERSION );

if ( defined( 'MEDIAWIKI' ) ) {
	$GLOBALS['wgExtensionCredits']['datavalues'][] = array(
		'path' => __DIR__,
		'name' => 'DataValuesInterfaces',
		'version' => DATAVALUES_INTERFACES_VERSION,
		'author' => array(
			'[https://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw]',
		),
		'url' => 'https://github.com/DataValues/Interfaces',
		'description' => 'Defines interfaces for ValueParsers, ValueFormatters and ValueValidators',
	);
}
