<?php
/**
 * JAWS-UG WordPress Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JAWS_UG_WP
 */

if ( ! function_exists( 'jawsugwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jawsugwp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'jawsugwp', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slide-thumb', 210, 90 );
	add_image_size( 'archive-thumb', 150, 150 );

	// Other
	add_post_type_support( 'page', 'excerpt' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu'   => __( 'Main Menu', 'jawsugwp' ),
		'footer_menu' => __( 'Footer Menu', 'jawsugwp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'jawsugwp_custom_background_args', array(
		'default-color'      => '020610',
		'default-image'      => '%1$s/images/background.png',
		'default-position-y' => 'bottom',
		'default-repeat'     => 'repeat-x',
		'wp-head-callback'   => 'jawsugwp_custom_background_cb',

	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'width'       => 190,
		'height'      => 50,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif; // jawsugwp_setup
add_action( 'after_setup_theme', 'jawsugwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jawsugwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jawsugwp_content_width', 900 );
}
add_action( 'after_setup_theme', 'jawsugwp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jawsugwp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'jawsugwp' ),
		'id'            => 'footer-widgets-area',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jawsugwp_widgets_init' );

/**
 * version 
 *
 * @link http://memo.dogmap.jp/2015/02/27/wordpress-git-commit-id-to-theme-version/
 */
$theme_data = wp_get_theme();
$version  = $theme_data->get( 'Version' );
$stylesheet_dir = untrailingslashit(ABSPATH);
if ( file_exists( $stylesheet_dir.'/.git/HEAD' ) ) {
	$head = explode(' ', trim(file_get_contents($stylesheet_dir.'/.git/HEAD')) );
	if ( isset($head[1]) && file_exists($stylesheet_dir.'/.git/'.$head[1]) ) {
		$version = trim(file_get_contents($stylesheet_dir.'/.git/'.$head[1]));
	}
}
define( 'THEME_VERSION', $version );

/**
 * Enqueue scripts and styles.
 */
function jawsugwp_scripts() {

	$jawsugwp_theme_ver  = THEME_VERSION;
	$jawsugwp_stylesheet = get_stylesheet_uri();

	if ( defined( 'WP_DEBUG' ) && ( WP_DEBUG == true ) && file_exists( get_stylesheet_directory() . '/css/style.css' ) ) { // WP_DEBUG = ture
		$jawsugwp_stylesheet = get_stylesheet_directory_uri() . '/css/style.css';
	}

	// Open Sans
	wp_enqueue_style( 'open-sans' );

	/**
	 * FontAwesome
	 *
	 * @link https://fontawesome.com/
	 */
	wp_enqueue_script(
		'font-awesome',
		'https://use.fontawesome.com/releases/v5.0.2/js/all.js',
		array(),
		'v5.0.2'
	);

	/**
	 * jquery.bxslider ver 4.1.2
	 *
	 * @link http://bxslider.com/
	 */
	wp_enqueue_script(
		'bxslider',
		'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js',
		array(),
		'4.2.12',
		true
	);

	/**
	 * FooTable
	 *
	 * @link http://fooplugins.github.io/FooTable/
	 */
	wp_enqueue_script(
		'FooTable',
		get_template_directory_uri() . '/footable/js/footable.js',
		array(),
		'2.0.3',
		true
	);
	wp_enqueue_style(
		'FooTable',
		get_template_directory_uri() . '/footable/css/footable.core.css',
		array(),
		'2.0.3'
	);

	wp_enqueue_style(
		'jawsugwp-style',
		$jawsugwp_stylesheet,
		array(),
		$jawsugwp_theme_ver
	);

	wp_enqueue_script(
		'jawsugwp-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		'20151215',
		true
	);

	wp_enqueue_script(
		'jawsugwp-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		'20151215',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script(
		'jawsugwp-script',
		get_stylesheet_directory_uri() . '/js/jawsugwp.js',
		array('jquery'),
		$jawsugwp_theme_ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'jawsugwp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Supporter slide file.
 */
require get_template_directory() . '/inc/slide.php';
