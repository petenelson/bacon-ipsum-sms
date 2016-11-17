<?php
/**
Plugin Name: Bacon Ipsum SMS
Description: SMS support for Bacon Ipsum
Version:     1.0.0
Author:      Pete Nelson <a href="https://twitter.com/GunGeekATX">(@GunGeekATX)</a>
Author URI:  https://petenelson.io
Text Domain: bacon-ipsum-sms
Domain Path: /languages
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'BACON_IPSUM_SMS_ROOT' ) ) {
	define( 'BACON_IPSUM_SMS_ROOT', trailingslashit( dirname( __FILE__ ) ) );
}

if ( ! defined( 'BACON_IPSUM_SMS_PATH' ) ) {
	define( 'BACON_IPSUM_SMS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'BACON_IPSUM_SMS_URL_ROOT' ) ) {
	define( 'BACON_IPSUM_SMS_URL_ROOT', trailingslashit( plugins_url( '/', __FILE__ ) ) );
}

// Load plugin files.
require_once BACON_IPSUM_SMS_ROOT . 'includes/rest-api.php';

\Bacon_Ipsum\SMS\REST_API\setup();
