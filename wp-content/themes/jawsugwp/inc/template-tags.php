<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package JAWS_UG_WP
 */

if ( ! function_exists( 'jawsugwp_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function jawsugwp_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'jawsugwp' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'jawsugwp' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'jawsugwp_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jawsugwp_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'jawsugwp' ) );
		if ( $categories_list && jawsugwp_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'jawsugwp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'jawsugwp' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'jawsugwp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'jawsugwp' ), esc_html__( '1 Comment', 'jawsugwp' ), esc_html__( '% Comments', 'jawsugwp' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'jawsugwp' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function jawsugwp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'jawsugwp_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'jawsugwp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so jawsugwp_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so jawsugwp_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in jawsugwp_categorized_blog
 */
function jawsugwp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'jawsugwp_categories' );
}
add_action( 'edit_category', 'jawsugwp_category_transient_flusher' );
add_action( 'save_post',     'jawsugwp_category_transient_flusher' );

/**
 * Session Level tag.
 */
function the_jawsugwp_session_level() {
	$levels = get_the_terms( $post->ID, 'session_level' );
	if ( $levels && ! is_wp_error( $levels ) ) {
		$levels_array = array();
		foreach ( $levels as $term ) {
			$levels_array[] = $term->name;
		}
		$levelstext = join( " / ", $levels_array );
		echo '<span class="session-meta-parts"><i class="fa fa-star" aria-hidden="true"></i> ' . esc_html( $levelstext ) . '</span>' . "\n";
	}
}

/**
 * Session Venue tag.
 */
function the_jawsugwp_session_venue() {
	$venues = get_the_terms( $post->ID, 'session_venue' );
	if ( $venues && ! is_wp_error( $venues ) ) {
		$venues_name_array = array();
		$venues_name = '';
		$venues_hash_array = array();
		$venues_hash = '';
		$text = get_the_title() . ' | ' . get_bloginfo( 'name' );
		$url  = get_the_permalink();
		foreach ( $venues as $term ) {
			$venues_name_array[] = $term->name;
			$venues_hash_array[] = '<a href="https://twitter.com/intent/tweet?text=' . urlencode( $text ) . '&amp;hashtags=jawsug,jawsdays,' . esc_html( $term->slug ) . '&amp;via=jawsdays&amp;url=' . urlencode( $url ). '" target="_blank">' . esc_html( '#' . $term->slug ) . '</a>';
		}
		$venues_name = join( " / ", $venues_name_array );
		$venues_hash = join( " / ", $venues_hash_array );
		
		echo '<span class="session-meta-parts"><i class="fa fa-location-arrow" aria-hidden="true"></i> ' . esc_html( $venues_name ) . '</span>' . "\n";
		echo '<span class="session-meta-parts"><i class="fa fa-hashtag" aria-hidden="true"></i> ' . $venues_hash . '</span>' . "\n";
	}
}

/**
 * Session Time tag.
 */
function the_jawsugwp_session_time() {
	if ( ! function_exists( 'get_field' ) )
		return;
	
	$start_time = get_field( 'start_time' );
	$end_time   = get_field( 'end_time' );
	if ( $start_time || $end_time) {
		echo '<span class="session-meta-parts"><i class="fa fa-clock-o" aria-hidden="true"></i> ';
	}
	if ( $start_time ) {
		echo get_field( 'start_time' );
		echo '〜';
	}
	if ( $end_time ) {
		echo get_field( 'end_time' );
	}
	if ( $start_time || $end_time) {
		echo '</span>';
	}
}
