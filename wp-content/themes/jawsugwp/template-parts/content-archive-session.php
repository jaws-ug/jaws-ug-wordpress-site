<?php
/**
 * Template part for displaying supporter posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package JAWS_UG_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'session-archive' ); ?>>

	<header class="entry-header">
		<?php do_action( 'jawsugwp_before_entry_header' ); ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="session-meta">
			<?php /* 難易度 */ the_jawsugwp_session_level(); ?>
			<?php /* 会場 */ the_jawsugwp_session_venue(); ?>
			<?php /* 時間 */ the_jawsugwp_session_time();?>
		</div>
		<?php // 登壇者
			if( have_rows( 'speaker' ) ):
				echo '<div class="session-meta"><i class="fa fa-microphone" aria-hidden="true"></i> ';
				// loop through the rows of data
				$speaker_name_array = array();
				$speaker_name = '';
				while ( have_rows( 'speaker' ) ) : the_row();
					$speaker_name_array[] = esc_html( get_sub_field( 'name' ) );
				endwhile;
				$speaker_name = join( " / ", $speaker_name_array );
				echo '<span class="session-meta-name">' . $speaker_name . '</span> ';
				echo '</div>' . "\n";
			endif;
		?>
		<?php do_action( 'jawsugwp_after_entry_header' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<p class="entry-more"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'jawsugwp' ) ?></a></p>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
