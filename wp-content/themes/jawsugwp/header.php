<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JAWS_UG_WP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'jawsugwp_before_body' ); ?>
       
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jawsugwp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php do_action( 'jawsugwp_before_header' ); ?>

		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><?php the_custom_logo(); ?></h1>
			<?php else : ?>
				<p class="site-title"><?php the_custom_logo(); ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'jawsugwp' ); ?></span><i class="fas fa-bars"></i></button>
			<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<div id="google_translate_element" style="float: right;"></div>
		<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'ja', gaTrack: true, gaId: 'UA-57886388-5'}, 'google_translate_element');
		}
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<?php do_action( 'jawsugwp_after_header' ); ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php do_action( 'jawsugwp_before_content' ); ?>
