<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package JAWS_UG_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-thumbnail"><span>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'archive-thumb' ); ?>
	<?php else : ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="no-image" width="150" height="150" srcset="<?php echo get_template_directory_uri(); ?>/images/no-image.png, <?php echo get_template_directory_uri(); ?>/images/no-image@2x.png 2x" />
	<?php endif; ?>
	</span></div>

	<header class="entry-header">
		<?php do_action( 'jawsugwp_before_entry_header' ); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php jawsugwp_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
		?>
		<?php do_action( 'jawsugwp_after_entry_header' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php do_action( 'jawsugwp_before_entry_content' ); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jawsugwp' ),
				'after'  => '</div>',
			) );
		?>
		<?php do_action( 'jawsugwp_after_entry_content' ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

