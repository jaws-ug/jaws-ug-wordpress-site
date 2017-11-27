<?php
/**
 * Feed
 *
 * @ JAWSUGWP_Setting
 */

// Disable comments feed link
add_filter( 'feed_links_show_comments_feed', function() { return false; } );

/**
 * Disable comments feed
 */
function feed_force_404( $obj ) {
	// 条件分岐タグの利用可
	if ( $obj->is_comment_feed ) { // $obj->is_feed で全てのフィード
		wp_die("Not Found.<br>".'<a href="'.home_url('/').'">Back to Home.</a>', '', array( 'response' => 404, "back_link" => true ));
	}
}
add_action( 'parse_query', 'feed_force_404' );

