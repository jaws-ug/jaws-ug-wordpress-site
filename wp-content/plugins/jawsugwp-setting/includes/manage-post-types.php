<?php
/**
 * Manage Custom Post Types
 *
 * @ JAWSUGWP_Setting
 */

// Register Custom Post Type - Session
function custom_post_type_session() {
	$tax_labels = array(
		'name'                       => _x( 'セッション', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( 'セッション', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( 'セッション', 'jawsugwp' ),
		'all_items'                  => __( 'All セッション', 'jawsugwp' ),
		'parent_item'                => __( 'Parent セッション', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent セッション:', 'jawsugwp' ),
		'new_item_name'              => __( 'New セッション Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New セッション', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit セッション', 'jawsugwp' ),
		'update_item'                => __( 'Update セッション', 'jawsugwp' ),
		'view_item'                  => __( 'View セッション', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate セッション with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove セッション', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular セッション', 'jawsugwp' ),
		'search_items'               => __( 'Search セッション', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No セッション', 'jawsugwp' ),
		'items_list'                 => __( 'セッション list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'セッション list navigation', 'jawsugwp' ),
	);
	$tax_args = array(
		'labels'                     => $tax_labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'meta_box_cb'                => false,
	);
	register_taxonomy( 'session_track', array( 'session' ), $tax_args );

	$tax_labels = array(
		'name'                       => _x( 'トラック', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( 'トラック', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( 'トラック', 'jawsugwp' ),
		'all_items'                  => __( 'All トラック', 'jawsugwp' ),
		'parent_item'                => __( 'Parent トラック', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent トラック:', 'jawsugwp' ),
		'new_item_name'              => __( 'New トラック Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New トラック', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit トラック', 'jawsugwp' ),
		'update_item'                => __( 'Update トラック', 'jawsugwp' ),
		'view_item'                  => __( 'View トラック', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate トラック with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove トラック', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular トラック', 'jawsugwp' ),
		'search_items'               => __( 'Search トラック', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No トラック', 'jawsugwp' ),
		'items_list'                 => __( 'トラック list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'トラック list navigation', 'jawsugwp' ),
	);
	$tax_args = array(
		'labels'                     => $tax_labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'meta_box_cb'                => false,
	);
	register_taxonomy( 'session_venue', array( 'session' ), $tax_args );

	$tax_labels = array(
		'name'                       => _x( 'Levels', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( 'Level', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( 'Level', 'jawsugwp' ),
		'all_items'                  => __( 'All Levels', 'jawsugwp' ),
		'parent_item'                => __( 'Parent Level', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent Level:', 'jawsugwp' ),
		'new_item_name'              => __( 'New Level Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New Level', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit Level', 'jawsugwp' ),
		'update_item'                => __( 'Update Level', 'jawsugwp' ),
		'view_item'                  => __( 'View Level', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate levels with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove levels', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular Levels', 'jawsugwp' ),
		'search_items'               => __( 'Search Levels', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No levels', 'jawsugwp' ),
		'items_list'                 => __( 'Levels list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'Levels list navigation', 'jawsugwp' ),
	);
	$tax_args = array(
		'labels'                     => $tax_labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'meta_box_cb'                => false,
	);
	register_taxonomy( 'session_level', array( 'session' ), $tax_args );

	$labels = array(
		'name'                => _x( 'Sessions', 'Post Type General Name', 'jawsugwp' ),
		'singular_name'       => _x( 'Session', 'Post Type Singular Name', 'jawsugwp' ),
		'menu_name'           => _x( 'Sessions', 'Post Type Menu Name', 'jawsugwp' ),
		'parent_item_colon'   => __( 'Parent Item:', 'jawsugwp' ),
		'all_items'           => __( 'All Items', 'jawsugwp' ),
		'view_item'           => __( 'View Item', 'jawsugwp' ),
		'add_new_item'        => __( 'Add New Item', 'jawsugwp' ),
		'add_new'             => __( 'Add New', 'jawsugwp' ),
		'edit_item'           => __( 'Edit Item', 'jawsugwp' ),
		'update_item'         => __( 'Update Item', 'jawsugwp' ),
		'search_items'        => __( 'Search Item', 'jawsugwp' ),
		'not_found'           => __( 'Not found', 'jawsugwp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'jawsugwp' ),
	);
	$args = array(
		'label'               => _x( 'Sessions', 'Post Type label', 'jawsugwp' ),
		'description'         => _x( 'Session', 'Post Type description', 'jawsugwp' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'page-attributes', 'revisions', 'publicize', 'wpcom-markdown' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-megaphone',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array( 'slug' => 'session', 'with_front' => false ),
		'sptp_permalink_structure' => 'session/%post_id%',
	);
	register_post_type( 'session', $args );
}
add_action( 'init', 'custom_post_type_session', 0 );

// Register Custom Post Type - Supporter
function custom_post_type_supporter() {

	$tax_labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( 'Type', 'jawsugwp' ),
		'all_items'                  => __( 'All Types', 'jawsugwp' ),
		'parent_item'                => __( 'Parent Type', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent Type:', 'jawsugwp' ),
		'new_item_name'              => __( 'New Type Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New Type', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit Type', 'jawsugwp' ),
		'update_item'                => __( 'Update Type', 'jawsugwp' ),
		'view_item'                  => __( 'View Type', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular Types', 'jawsugwp' ),
		'search_items'               => __( 'Search Types', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No types', 'jawsugwp' ),
		'items_list'                 => __( 'Types list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'Types list navigation', 'jawsugwp' ),
	);
	$tax_args = array(
		'labels'                     => $tax_labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'supporter_type', array( 'supporter' ), $tax_args );

	$labels = array(
		'name'                => _x( 'Supporters', 'Post Type General Name', 'jawsugwp' ),
		'singular_name'       => _x( 'Supporter', 'Post Type Singular Name', 'jawsugwp' ),
		'menu_name'           => _x( 'Supporters', 'Post Type Menu Name', 'jawsugwp' ),
		'parent_item_colon'   => __( 'Parent Item:', 'jawsugwp' ),
		'all_items'           => __( 'All Items', 'jawsugwp' ),
		'view_item'           => __( 'View Item', 'jawsugwp' ),
		'add_new_item'        => __( 'Add New Item', 'jawsugwp' ),
		'add_new'             => __( 'Add New', 'jawsugwp' ),
		'edit_item'           => __( 'Edit Item', 'jawsugwp' ),
		'update_item'         => __( 'Update Item', 'jawsugwp' ),
		'search_items'        => __( 'Search Item', 'jawsugwp' ),
		'not_found'           => __( 'Not found', 'jawsugwp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'jawsugwp' ),
	);
	$args = array(
		'label'               => _x( 'Supporters', 'Post Type label', 'jawsugwp' ),
		'description'         => _x( 'Supporter', 'Post Type description', 'jawsugwp' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'publicize', 'wpcom-markdown' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-awards',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array( 'slug' => 'supporter', 'with_front' => false ),
		'sptp_permalink_structure' => 'supporter/%post_id%',
	);
	register_post_type( 'supporter', $args );
}
add_action( 'init', 'custom_post_type_supporter', 0 );

// Register Custom Post Type - overseasguest
// Add 2018/01/26 HisakoIsaka
function custom_post_type_overseasguest() {

	$tax_labels = array(
		'name'                       => _x( '海外ゲスト', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( '海外ゲスト', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( '海外ゲスト', 'jawsugwp' ),
		'all_items'                  => __( 'All Types', 'jawsugwp' ),
		'parent_item'                => __( 'Parent Type', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent Type:', 'jawsugwp' ),
		'new_item_name'              => __( 'New Type Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New Type', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit Type', 'jawsugwp' ),
		'update_item'                => __( 'Update Type', 'jawsugwp' ),
		'view_item'                  => __( 'View Type', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular Types', 'jawsugwp' ),
		'search_items'               => __( 'Search Types', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No types', 'jawsugwp' ),
		'items_list'                 => __( 'Types list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'Types list navigation', 'jawsugwp' ),
	);
	$tax_args = array(
		'labels'                     => $tax_labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'overseasguest_type', array( 'overseasguest' ), $tax_args );

	$labels = array(
		'name'                => _x( '海外ゲスト', 'Post Type General Name', 'jawsugwp' ),
		'singular_name'       => _x( '海外ゲスト', 'Post Type Singular Name', 'jawsugwp' ),
		'menu_name'           => _x( '海外ゲスト', 'Post Type Menu Name', 'jawsugwp' ),
		'parent_item_colon'   => __( 'Parent Item:', 'jawsugwp' ),
		'all_items'           => __( 'All Items', 'jawsugwp' ),
		'view_item'           => __( 'View Item', 'jawsugwp' ),
		'add_new_item'        => __( 'Add New Item', 'jawsugwp' ),
		'add_new'             => __( 'Add New', 'jawsugwp' ),
		'edit_item'           => __( 'Edit Item', 'jawsugwp' ),
		'update_item'         => __( 'Update Item', 'jawsugwp' ),
		'search_items'        => __( 'Search Item', 'jawsugwp' ),
		'not_found'           => __( 'Not found', 'jawsugwp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'jawsugwp' ),
	);
	$args = array(
		'label'               => _x( 'overseasguests', 'Post Type label', 'jawsugwp' ),
		'description'         => _x( 'overseasguest', 'Post Type description', 'jawsugwp' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'publicize', 'wpcom-markdown' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-awards',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array( 'slug' => 'overseasguest', 'with_front' => false ),
		'sptp_permalink_structure' => 'overseasguest/%post_id%',
	);
	register_post_type( 'overseasguest', $args );
}
add_action( 'init', 'custom_post_type_overseasguest', 0 );

// Term sort for Custom Post Type
function jaws_restrict_manage_posts( $post_type ) {
	if ( 'supporter' == $post_type ) {
		$term_slug = get_query_var( 'supporter_type' );
		wp_dropdown_categories( array(
			'show_option_all'    => __( 'All Types', 'jawsugwp' ),
			'hide_empty'         => 0,
			'selected'           => $term_slug,
			'name'               => 'supporter_type',
			'taxonomy'           => 'supporter_type',
			'value_field'	     => 'slug',	
		));
	} elseif ( 'session' == $post_type ) {
		$track_var = get_query_var( 'session_track' );
		$venue_var = get_query_var( 'session_venue' );
		wp_dropdown_categories( array(
			'show_option_all'    => __( 'All Tracks', 'jawsugwp' ),
			'hide_empty'         => 0,
			'selected'           => $track_var,
			'name'               => 'session_track',
			'taxonomy'           => 'session_track',
			'value_field'	     => 'slug',	
		));
		wp_dropdown_categories( array(
			'show_option_all'    => __( 'All Venues', 'jawsugwp' ),
			'hide_empty'         => 0,
			'selected'           => $venue_var,
			'name'               => 'session_venue',
			'taxonomy'           => 'session_venue',
			'value_field'	     => 'slug',	
		));
	} elseif ( 'overseasguest' == $post_type ) { // Add 2018/01/26 HisakoIsaka
		$term_slug = get_query_var( 'overseasguest_type' );
		wp_dropdown_categories( array(
			'show_option_all'    => __( 'All Types', 'jawsugwp' ),
			'hide_empty'         => 0,
			'selected'           => $term_slug,
			'name'               => 'overseasguest_type',
			'taxonomy'           => 'overseasguest_type',
			'value_field'	     => 'slug',	
		));
	}
}
add_action( 'restrict_manage_posts', 'jaws_restrict_manage_posts', 10, 2 );

// Add custom column for session post list in dashboard.
function jaws_session_posts_columns( $columns ) {
	$new_columns = array();
	foreach ( $columns as $column_name => $column_display_name ) {
		if ( $column_name == 'taxonomy-session_level' ) {
			$new_columns['start_time'] = __( 'Start Time', 'jawsugwp' );
			$new_columns['end_time'] = __( 'End Time', 'jawsugwp' );
		}
		$new_columns[ $column_name ] = $column_display_name;
	}	

	return $new_columns;
}
add_filter( 'manage_session_posts_columns', 'jaws_session_posts_columns' );

function jaws_session_posts_custom_column( $column, $post_id ) {
	switch ( $column ) {
	
		case 'start_time' :
			echo get_post_meta( $post_id , 'start_time' , true ); 
			break;
	
		case 'end_time' :
			echo get_post_meta( $post_id , 'end_time' , true ); 
			break;

	}
}
add_action( 'manage_session_posts_custom_column', 'jaws_session_posts_custom_column', 10, 2 );

/**
 * Query pre_get_posts for supporter and session
 * http://notnil-creative.com/blog/archives/1996
 */
function jaws_modify_main_query( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// サポーターとセッションの投稿タイプははアーカイブを作成しない
	if ( $query->is_post_type_archive( array( 'supporter', 'session' ) ) ) {
		$query->set( 'posts_per_archive_page', -1 );
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'ASC' );
		return;
	}

}
add_action( 'pre_get_posts', 'jaws_modify_main_query' );
