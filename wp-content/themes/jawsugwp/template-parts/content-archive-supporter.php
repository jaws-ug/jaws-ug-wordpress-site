<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package JAWS_UG_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'supporter-archive' ); ?>>

	<div class="post-thumbnail"><a href="<?php the_permalink(); ?>" rel="bookmark">
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'archive-thumb' ); ?>
	<?php else : ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="no-image" width="150" height="150" srcset="<?php echo get_template_directory_uri(); ?>/images/no-image.png, <?php echo get_template_directory_uri(); ?>/images/no-image@2x.png 2x" />
	<?php endif; ?>
	</a></div>

	<header class="entry-header">
		<?php do_action( 'jawsugwp_before_entry_header' ); ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php do_action( 'jawsugwp_after_entry_header' ); ?>
	</header><!-- .entry-header -->


</article><!-- #post-## -->
