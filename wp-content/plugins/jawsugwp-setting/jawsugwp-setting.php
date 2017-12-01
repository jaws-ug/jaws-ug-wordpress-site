<?php
/**
 * Plugin Name: JAWS UG WordPress Setting
 * Plugin URI:  https://github.com/jaws-ug/jaws-ug-wordpress-site
 * Description: Setting required when building sites for JAWS DYAS and JAWS FESTA with WordPress.
 * Version:     2018
 * Author:      IGARASHI Kazue
 * Author URI:  https://gatespace.jp/
 * License:     GPLv2
 * Text Domain: jawsugwp
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2015 IGARASHI Kazue ( https://gatespace.jp/ )
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */



define( 'JAWSUGWP_URL',  plugins_url( '', __FILE__ ) );
define( 'JAWSUGWP_PATH', dirname( __FILE__ ) );

$jawsugwp = new JAWSUGWP_Setting();
$jawsugwp->register();

class JAWSUGWP_Setting {

private $version = '';
private $langs   = '';

function __construct() {
	$data = get_file_data(
		__FILE__,
		array( 'ver' => 'Version', 'langs' => 'Domain Path' )
	);
	$this->version = $data['ver'];
	$this->langs   = $data['langs'];
}

public function register() {
	add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
}

public function plugins_loaded() {
	load_plugin_textdomain(
		'jawsugwp',
		false,
		dirname( plugin_basename( __FILE__ ) ) . $this->langs
	);

	// Manage Custom Post Types
	require_once( dirname(__FILE__) . '/includes/manage-post-types.php' );

	// ACF
	require_once( dirname(__FILE__) . '/includes/acf.php' );

	// Feed
	require_once( dirname(__FILE__) . '/includes/feed.php' );

	// Disable author archive. 
	add_filter( 'author_rewrite_rules', '__return_empty_array' );

	// Yast SEO override
/*
	add_filter( 'wpseo_opengraph_image', array( $this, 'jaws_wpseo_opengraph_image' ) );
	add_filter( 'wpseo_twitter_image', array( $this, 'jaws_wpseo_opengraph_image' ) );
*/
}


// Yoast SEO
public function jaws_wpseo_opengraph_image( $image ) {
	if ( is_singular( 'session' ) || is_post_type_archive( 'session' ) ) {
		$image = JAWSUGWP_URL . '/images/ogp-default-image.png';
	} elseif ( is_post_type_archive( 'supporter' ) ) {
		$image = JAWSUGWP_URL . '/images/ogp-default-image.png';
	}
	return $image;
}

} // end class JAWSUGWP_Setting

// EOF
