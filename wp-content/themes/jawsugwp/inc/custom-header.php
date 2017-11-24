<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package JAWS_UG_WP
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses jawsugwp_header_style()
 */
function jawsugwp_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'jawsugwp_custom_header_args', array(

		'default-image'          => get_parent_theme_file_uri( '/images/default-image.png' ),
		'width'                  => 1000,
		'height'                 => 400,
		'flex-height'            => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/images/default-image.png',
			'thumbnail_url' => '%s/images/default-image.png',
			'description'   => __( 'Default Header Image', 'jawsugwp' ),
		),
	) );
}
add_action( 'after_setup_theme', 'jawsugwp_custom_header_setup' );
