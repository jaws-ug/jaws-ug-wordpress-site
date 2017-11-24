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

	// Register Custom Post Type
	add_action( 'init', array( $this, 'custom_post_type_session' ), 0 );
	add_action( 'init', array( $this, 'custom_post_type_supporter' ), 0 );
	// Term sort for Custom Post Type
	add_action( 'restrict_manage_posts', array( $this, 'jaws_restrict_manage_posts' ), 10, 2 );
	// Query pre_get_posts
	add_action( 'pre_get_posts', array( $this, 'jaws_modify_main_query' ) );
	// ACF
	add_filter( 'acf/settings/save_json', array( $this, 'jaws_acf_json_save_point' ) );
	add_filter( 'acf/settings/load_json', array( $this, 'jaws_acf_json_load_point' ) );
	add_action( 'admin_print_styles', array( $this, 'jaws_acf_css' ) );
	// Add custom column for session post list in dashboard.
	add_filter( 'manage_session_posts_columns', array( $this, 'jaws_session_posts_columns' ) );
	add_action( 'manage_session_posts_custom_column', array( $this, 'jaws_session_posts_custom_column' ), 10, 2 );
	// Yast SEO override
/*
	add_filter( 'wpseo_opengraph_image', array( $this, 'jaws_wpseo_opengraph_image' ) );
	add_filter( 'wpseo_twitter_image', array( $this, 'jaws_wpseo_opengraph_image' ) );
*/
}

// Register Custom Post Type - Session
public function custom_post_type_session() {
	$tax_labels = array(
		'name'                       => _x( 'Tracks', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( 'Track', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( 'Track', 'jawsugwp' ),
		'all_items'                  => __( 'All Tracks', 'jawsugwp' ),
		'parent_item'                => __( 'Parent Track', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent Track:', 'jawsugwp' ),
		'new_item_name'              => __( 'New Track Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New Track', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit Track', 'jawsugwp' ),
		'update_item'                => __( 'Update Track', 'jawsugwp' ),
		'view_item'                  => __( 'View Track', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate tracks with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove tracks', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular Tracks', 'jawsugwp' ),
		'search_items'               => __( 'Search Tracks', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No tracks', 'jawsugwp' ),
		'items_list'                 => __( 'Tracks list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'Tracks list navigation', 'jawsugwp' ),
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
		'name'                       => _x( 'Venues', 'Taxonomy General Name', 'jawsugwp' ),
		'singular_name'              => _x( 'Venue', 'Taxonomy Singular Name', 'jawsugwp' ),
		'menu_name'                  => __( 'Venue', 'jawsugwp' ),
		'all_items'                  => __( 'All Venues', 'jawsugwp' ),
		'parent_item'                => __( 'Parent Venue', 'jawsugwp' ),
		'parent_item_colon'          => __( 'Parent Venue:', 'jawsugwp' ),
		'new_item_name'              => __( 'New Venue Name', 'jawsugwp' ),
		'add_new_item'               => __( 'Add New Venue', 'jawsugwp' ),
		'edit_item'                  => __( 'Edit Venue', 'jawsugwp' ),
		'update_item'                => __( 'Update Venue', 'jawsugwp' ),
		'view_item'                  => __( 'View Venue', 'jawsugwp' ),
		'separate_items_with_commas' => __( 'Separate venues with commas', 'jawsugwp' ),
		'add_or_remove_items'        => __( 'Add or remove venues', 'jawsugwp' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'jawsugwp' ),
		'popular_items'              => __( 'Popular Venues', 'jawsugwp' ),
		'search_items'               => __( 'Search Venues', 'jawsugwp' ),
		'not_found'                  => __( 'Not Found', 'jawsugwp' ),
		'no_terms'                   => __( 'No venues', 'jawsugwp' ),
		'items_list'                 => __( 'Venues list', 'jawsugwp' ),
		'items_list_navigation'      => __( 'Venues list navigation', 'jawsugwp' ),
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

// Register Custom Post Type - Supporter
public function custom_post_type_supporter() {

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

public function jaws_restrict_manage_posts( $post_type ) {
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
	}
}

// Add custom column for session post list in dashboard.
public function jaws_session_posts_columns( $columns ) {
	// 任意の場所に追加
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
public function jaws_session_posts_custom_column( $column, $post_id ) {
	switch ( $column ) {
	
		case 'start_time' :
			echo get_post_meta( $post_id , 'start_time' , true ); 
			break;
	
		case 'end_time' :
			echo get_post_meta( $post_id , 'end_time' , true ); 
			break;

	}
}

/**
 * Query pre_get_posts
 * http://notnil-creative.com/blog/archives/1996
 */
public function jaws_modify_main_query( $query ) {

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

// ACF
public function jaws_acf_json_save_point( $path ) {

	// update path
	$path = JAWSUGWP_PATH . '/acf-json';

	// return
	return $path;

}
public function jaws_acf_json_load_point( $paths ) {

	// remove original path (optional)
	unset($paths[0]);

	// append path
	$paths[] = JAWSUGWP_PATH . '/acf-json';

	// return
	return $paths;

}
public function jaws_acf_css() {
?>
<style>
	.acf-taxonomy-field ul.acf-radio-list li,
	.acf-taxonomy-field ul.acf-checkbox-list li {
		display: inline-block;
		margin-right: 1em;
	}
</style>
<?php
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
