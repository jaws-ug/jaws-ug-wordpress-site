<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JAWS_UG_WP
 */

?>

		<?php do_action( 'jawsugwp_after_content' ); ?>
	</div><!-- #content -->

	<?php // Supporter slide ?>
	<?php supporter_slide(); ?>

	<?php if ( is_front_page() ) : ?>
		<section id="footer-widgets-area" class="footer-section footer-widgets-area">
		<?php if ( is_active_sidebar( 'footer-widgets-area' ) ) : ?>
			<?php dynamic_sidebar( 'footer-widgets-area' ); ?>
		<?php else: ?>
			<?php
				// News
				the_widget( 'WP_Widget_Recent_Posts',
					array(
						'title'     => __( 'News', 'jawsugwp' ),
						'number'    => 6,
						'show_date' => true,
					),
					array(
						'before_widget' => '<aside class="widget %s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				);
			?>
			<aside class="widget widget_twitter_timeline">
				<h2 class="widget-title">Twitter</h2>
				<a class="twitter-timeline"  href="https://twitter.com/jawsdays" data-widget-id="419796144944721920">@jawsdaysさんのツイート</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</aside>
			<aside class="widget widget_facebook_likebox">
				<h2 class="widget-title"><a href="https://www.facebook.com/jawsdays">Facebook</a></h2>
				<div class="fb-page" data-href="https://www.facebook.com/jawsug/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/jawsug/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/jawsug/">AWS User Group - Japan (JAWS-UG)</a></blockquote></div>
			</aside>
		<?php endif; ?>
		</section><!-- #footer-widgets-area -->
	<?php endif; ?>

	<?php
		$footer_section_view = get_theme_mod( 'footer_section_view' );
		if ( ! empty( $footer_section_view ) ) : 
	?>
	<section id="jawsugwp-contact-box" class="footer-section jawsugwp-contact-box"><div class="inner">
		<?php
			$footer_section_title = get_theme_mod( 'footer_section_title', sprintf(
				esc_html__( 'To participate in the JAWS DAYS %d', 'jawsugwp' ),
				2018
			) );
		?>
		<p class="contact-text" id="jawsugwp-contact-title"><?php echo esc_html( $footer_section_title ); ?></p>
		<?php
			$footer_section_btn_text  = get_theme_mod( 'footer_section_btn', __( 'Tickets', 'jawsugwp' ) );
		?>
		<?php
			$footer_section_link = get_theme_mod( 'footer_section_link', '' );
			if ( ! empty( $footer_section_link ) ) :
		?>
		<p class="contact-button"><a href="<?php echo get_permalink( $footer_section_link ); ?>" id="jawsugwp-contact-btn-link"><span id="jawsugwp-contact-btn-text"><?php echo esc_html( $footer_section_btn_text ); ?></span></a></p>
		<?php endif; ?>
		<div class="contact-other-text" id="jawsugwp-contact-other-text">
		<?php
			$footer_section_other = get_theme_mod( 'footer_section_other' );
			if ( ! empty( $footer_section_other ) ) {
				echo '<p>' . "\n";
				echo nl2br( $footer_section_other );
				echo '</p>' . "\n";
			}
		?>
		</div>
	</div></section>
	<?php endif; ?>

	<footer id="colophon" class="site-footer" role="contentinfo"><div class="inner">
		<?php do_action( 'jawsugwp_before_footer' ); ?>
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>
		</nav>
		<div class="site-info">
			<div class="social-button">
				<ul>
					<li><a href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode( get_bloginfo( 'name' ) ); ?>&url=<?php echo rawurlencode( home_url( '/' ) ); ?>&hashtags=jawsdays,jawsug&via=jawsdays" target="_blank">
<i class="fa fa-twitter-square"></i></a></li>
					<li><a href="https://www.facebook.com/dialog/share?app_id=1400003920114272&href=<?php echo rawurlencode( home_url( '/' ) ); ?>" target="_blank"><i class="fa fa-facebook-official"></i></a></li>
				</ul>
			</div>
			<p class="copyright">Copyright &copy; AWS User Group Japan. All rights reserved.</p>
		</div><!-- .site-info -->
		<?php do_action( 'jawsugwp_after_footer' ); ?>
	</div></footer><!-- #colophon -->
</div><!-- #page -->

<?php do_action( 'jawsugwp_after_body' ); ?>

<?php wp_footer(); ?>

</body>
</html>
