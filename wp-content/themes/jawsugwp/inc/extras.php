<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package JAWS_UG_WP
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jawsugwp_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'jawsugwp_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function jawsugwp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'jawsugwp_pingback_header' );

/**
 * Filter the archive title..
 *
 * @param string $title Archive title to be displayed.
 * @return string
 */
function jawsugwp_get_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'jawsugwp_get_the_archive_title' );

/**
 * WordPressの投稿作成画面で必須項目を作る（空欄ならJavaScriptのアラート）
 *
 * @link https://gist.github.com/gatespace/11020994
 */
add_action( 'admin_head-post-new.php', 'jawsugwp_post_edit_required' ); // 新規投稿画面でフック
add_action( 'admin_head-post.php', 'jawsugwp_post_edit_required' );     // 投稿編集画面でフック
function jawsugwp_post_edit_required() {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	if( 'supporter' == $('#post_type').val() ){ // サポーター
		$("#post").submit(function(e){ // 更新あるいは下書き保存を押したとき
			if( $("#set-post-thumbnail img").length < 1 ) { // アイキャッチ画像
				alert('アイキャッチ画像を設定してください！');
				$('.spinner').hide();
				$('#publish').removeClass('button-primary-disabled');
				$('#set-post-thumbnail').focus();
				return false;
			}
		});
	}
});
</script>
<?php
}

/**
 * TinyMCE
 */
// Callback function to insert 'styleselect' into the $buttons array
function jawsugwp_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'jawsugwp_mce_buttons_2' );

// Callback function to filter the MCE settings
function jawsugwp_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(  
			'title' => 'A ボタン',
			'inline' => 'a',
			'classes' => 'btn'
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;  

}
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'jawsugwp_mce_before_init_insert_formats' );

/**
 * Filters the custom logo output.
 *
 * @since 4.5.0
 * @since 4.6.0 Added the `$blog_id` parameter.
 *
 * @param string $html    Custom logo HTML output.
 * @param int    $blog_id ID of the blog to get the custom logo for.
 */
function jawsugwp_custom_logo( $html ) {
	// We have a logo. Logo is go.
	if ( ! empty( $html ) )
		return $html;

	$default_img    = get_template_directory_uri() . '/images/site-logo.png';
	$default_img_2x = get_template_directory_uri() . '/images/site-logo@2x.png';
	$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
		esc_url( home_url( '/' ) ),
		'<img src="' . $default_img  . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" srcset="' . $default_img . ', ' . $default_img_2x . ' 2x">'
	);
	return $html;  

}
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'get_custom_logo', 'jawsugwp_custom_logo' );

