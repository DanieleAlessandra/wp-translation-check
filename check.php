<?php
/**
 * Script to validate .mo files
 */
header( "Content-Type: text/plain" );

// Include the wp-load.php file of WordPress
require_once( __DIR__ . '/../../../../wp-load.php' );

// Force the WordPress locale for each .mo file
function set_locale( $locale ) {
	echo "Setting locale $locale\n";
	add_filter( 'locale', function() use ( $locale ) {
		return $locale;
	} );
	switch_to_locale( $locale );
	load_textdomain( 'default', WP_LANG_DIR . "/$locale.mo" );
}

const MESSAGE = 'Hello, this is a translated message!';

// Function to load the .mo file
function load_mo_file( $domain, $mofile ) {
	if ( !file_exists( $mofile ) ) {
        echo "File .mo not found: $mofile\n";
		return false;
	}
	$locale = substr( $mofile, strrpos( $mofile, '-' ) + 1, strrpos( $mofile, '.' ) - strrpos( $mofile, '-' ) - 1 );
	set_locale( $locale );

    // Load the .mo file
	$result = load_textdomain( $domain, $mofile );
	if ( $result ) {
        echo "File .mo successfully loaded: $mofile\n";
		return true;
	} else {
        echo "Error loading .mo file: $mofile\n";
		return false;
	}
}

// Function to scan the current directory for .mo files
function scan_for_mo_files( $dir ) {
	$mo_files = glob( $dir . '/*.mo' );
	if ( empty( $mo_files ) ) {
        echo "No .mo files found in the directory.\n";
	} else {
		foreach ( $mo_files as $mo_file ) {
			load_mo_file( 'test-domain', $mo_file );
			test_translation();
		}
	}
}

// Function to test the translation
function test_translation() {
	$translated_text = __( MESSAGE, 'test-domain' );
	if ( $translated_text === MESSAGE ) {
        echo "Translation not found.\n";
	} else {
        echo "Translated message: $translated_text\n";
	}
}

// Scan and test
scan_for_mo_files( __DIR__ );