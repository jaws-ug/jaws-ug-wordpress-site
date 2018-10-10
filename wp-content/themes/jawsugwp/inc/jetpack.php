<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package JAWS_UG_WP
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function jawsugwp_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'jawsugwp_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
} // end function jawsugwp_jetpack_setup
add_action( 'after_setup_theme', 'jawsugwp_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function jawsugwp_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
} // end function jawsugwp_infinite_scroll_render

/**
 * Moving Sharing Icons.
 *
 * @link http://jetpack.me/2013/06/10/moving-sharing-icons/
 */
function jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
 
add_action( 'loop_start', 'jptweak_remove_share' );

function jawsugwp_sharing_display() {
	if ( function_exists( 'sharing_display' ) ) {
		sharing_display( '', true );
	}
}
add_action( 'jawsugwp_after_entry_header', 'jawsugwp_sharing_display' );

/*
 * パブリサイズ共有
 */

add_action( 'publicize_save_meta', 'jawsugwp_publicize_save_meta', 10, 4);
function jawsugwp_publicize_save_meta( $submit_post, $post_id, $service_name, $connection ) {

	$prefix = "";
	if ( 'session' === get_post_type( $post_id ) ) {
		$prefix = "[セッション情報更新] ";
	} elseif ( 'supporter' === get_post_type( $post_id ) ) {
		$prefix = "[サポーター情報更新] ";
	}
	$title   = get_the_title( $post_id );
	$twitter_hash  = get_theme_mod( 'twitter_hash', 'jawsug,jawsdays' );
	$twitter_hashs = '';
	if ( ! empty( $twitter_hash ) ) {
		$twitter_hashs = ' #' . str_replace( ',', ' #', $twitter_hash );
		
	}
	$suffix  = $twitter_hashs;
	$link    = wp_get_shortlink( $post_id );
	$excerpt = get_the_excerpt( $post_id );

	$publicize_custom_message = get_post_meta( $post_id, '_wpas_mess', true );
	if ( empty( $publicize_custom_message ) ) {
		$publicize_custom_message = sprintf(
			"%s%s %s\n%s\n%s",
			$prefix,
			$title,
			$suffix,
			$link,
			$excerpt
		);
	} else {
		if ( strpos( $publicize_custom_message, $prefix ) === false ) {
			$publicize_custom_message = $prefix . $publicize_custom_message;
		}
		if ( strpos( $publicize_custom_message, $title ) === false ) {
			$publicize_custom_message = $publicize_custom_message . $title;
		}
		if ( strpos( $publicize_custom_message, $suffix ) === false ) {
			$publicize_custom_message = $publicize_custom_message . $suffix;
		}
		if ( strpos( $publicize_custom_message, $link ) === false ) {
			$publicize_custom_message = $publicize_custom_message . $link;
		}
		if ( strpos( $publicize_custom_message, $excerpt ) === false ) {
			$publicize_custom_message = $publicize_custom_message . $excerpt;
		}
	}
	delete_post_meta( $post_id, '_wpas_mess' );
	update_post_meta( $post_id, '_wpas_mess', $publicize_custom_message );
}