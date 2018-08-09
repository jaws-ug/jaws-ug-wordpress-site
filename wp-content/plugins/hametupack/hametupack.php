<?php
/*
Plugin Name: HametuPack
Plugin URI: http://wordpress.org/extend/plugins/hametupack/
Description: This plugin add small functionality to Jetpack.
Author: Hametuha
Version: 1.2.3
Text Domain: hametupack
Domain Path: /languages/
Author URI: https://hametuha.co.jp
*/

defined( 'ABSPATH' ) or die();


/**
 * Bootstrap this plugin
 *
 * @package hametupack
 * @internal
 */
function hametupack_plugins_loaded() {
	load_plugin_textdomain( 'hametupack', false, basename( dirname( __FILE__ ) ) . '/languages' );
	if ( version_compare( phpversion(), '5.5.0', '<' ) ) {
		add_action( 'admin_notices', 'hametupack_invalid_php' );
	} elseif ( ! defined( 'JETPACK__VERSION' ) ) {
		add_action( 'admin_notices', 'hametupack_no_jetpack' );
	} else {
		require __DIR__ . '/vendor/autoload.php';
		foreach ( scandir( __DIR__ . '/includes' ) as $file ) {
			if ( ! preg_match( '#^[^._].*\.php$#u', $file ) ) {
				continue;
			}
			require __DIR__ . '/includes/' . $file;
		}
	}
}
add_action( 'plugins_loaded', 'hametupack_plugins_loaded' );

/**
 * Error message
 *
 * @package hametupack
 * @internal
 */
function hametupack_invalid_php() {
	// translators: %s PHP version.
	$message =sprintf( __( 'Hametupack requires PHP5.5 and over, but yours %s.', 'hametupack' ), phpversion() );
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

/**
 * No Jetpack
 *
 * @package hametupack
 * @internal
 */
function hametupack_no_jetpack() {
	// translators: %s Jetpack URL.
	$message =sprintf( __( 'Hametupack works with <a href="%s" target="_blank">Jetpack</a> but not activated.', 'hametupack' ), 'https://jetpack.me' );
	printf( '<div class="error"><p>%s</p></div>', wp_kses_post( $message ) );
}

/**
 * Get plugin version
 *
 * @package hametupack
 * @return string
 */
function hametupack_version() {
	static $data = null;
	if ( is_null( $data ) ) {
		$data = get_file_data( __FILE__, array(
			'version' => 'Version',
		) );
	}
	return $data['version'];
}

/**
 * Flush rules for plugin activation.
 */
function hametupack_flush_rules() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'hametupack_flush_rules' );
