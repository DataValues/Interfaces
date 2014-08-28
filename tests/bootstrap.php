<?php

if ( PHP_SAPI !== 'cli' ) {
	die( 'Not an entry point' );
}

$pwd = exec( 'pwd' );
chdir( __DIR__ . '/..' );
passthru( 'composer update' );
chdir( $pwd );

require_once( __DIR__ . '/../vendor/autoload.php' );
