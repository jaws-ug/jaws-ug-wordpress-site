<?php
/**
 * AMP helper
 *
 * @package hametupack
 */


/**
 * Change sharing HTML if amp requested.
 *
 * @param string $markup
 * @param array  $sharing_enabled
 * @return string
 */
add_filter( 'jetpack_sharing_display_markup', function( $markup, $sharing_enabled = [] ) {
	if ( empty( $sharing_enabled ) || ! function_exists( 'is_amp_endpoint' ) || ! is_amp_endpoint() ) {
		return $markup;
	}
	$markup = preg_replace_callback( '#<\!-- not supported: ([^ ]+) -->#', function( $matches ) {
		/**
		 * hametupack_amp_share_button
		 *
		 * Filter for not supported jetpack share button on AMP.
		 *
		 * @param string $markup  Default markup comment.
		 * @param string $service Service name.
		 * @return string
		 */
		return apply_filters( 'hametupack_amp_share_button', $matches[0], $matches[1] );
	}, $markup );
	// Remove li tag.
	$markup = preg_replace( '#<li.+</li>#us', '', $markup );
	$markup = str_replace( '</div></li></ul></div></div>', '', $markup );
	return $markup;
}, 11, 2 );

/**
 * Fix button layout
 */
add_action( 'amp_post_template_css', function() {
	$asset_pass = plugin_dir_url( __DIR__ ) . 'src/img/';
	echo <<<CSS
.amp-social-share-hatebu{
	background:#01A4DE url("{$asset_pass}hatenabookmark-logomark.svg") center center no-repeat;
	background-size: 60px 44px;
}
CSS;

} );
