<?php
/**
 * Template part for displaying supporter posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package JAWS_UG_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php do_action( 'jawsugwp_before_entry_header' ); ?>
		<?php // カテゴリー
			$trackstext = '';
			$tracks = get_the_terms( $post->ID, 'session_track' );
			if ( $tracks && ! is_wp_error( $tracks ) ) {
				$tracks_array = array();
				foreach ( $tracks as $term ) {
				$tracks_array[] = esc_html( $term->name );
				}
				$trackstext = join( " / ", $tracks_array );
				$trackstext = ' [' . $trackstext . '] ';
			} 
		?>
		<?php the_title( '<h1 class="entry-title">' . $trackstext, '</h1>' ); ?>
		<div class="session-meta">
			<?php /* 難易度 */ the_jawsugwp_session_level(); ?>
			<?php /* 会場 */ the_jawsugwp_session_venue(); ?>
			<?php /* 時間 */ the_jawsugwp_session_time();?>
		</div>
		<?php do_action( 'jawsugwp_after_entry_header' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php do_action( 'jawsugwp_before_entry_content' ); ?>

		<?php the_content(); ?>
		
		<?php
			// 登壇者
			if( have_rows( 'speaker' ) ):
				echo '<h2>' . __( 'Speakers', 'jawsugwp' ) . '</h2>' . "\n";
				// loop through the rows of data
				while ( have_rows( 'speaker' ) ) : the_row();
				echo '<div class="speaker">';

					// Image
					$image = get_sub_field( 'image' );
					$size  = 'thumbnail';
					if( $image ) {
						echo '<div class="post-thumbnail"><span>';
						echo wp_get_attachment_image( $image, $size );
						echo '</span></div>' . "\n";
					}

					// Name
					echo '<p class="speaker-name">';
					the_sub_field( 'name' );
					echo '</p>' . "\n";
				?>
				<?php if ( get_sub_field( 'site_url' ) || get_sub_field( 'twitter' ) || get_sub_field( 'facebook' ) || get_sub_field( 'github' ) ) : ?>
				<div class="speaker-sns">
				<?php
					// Blog
					if ( get_sub_field( 'site_url' ) ) {
						echo '<a href="' . esc_url( get_sub_field( 'site_url' ) ) . '" target="_blank"><i class="fas fa-globe"></i></a>';
					}
					// Twitter
					if ( get_sub_field( 'twitter' ) ) {
						echo '<a href="' . esc_url( 'https://twitter.com/' . get_sub_field( 'twitter' ) ) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
					}
					// Facebook
					if ( get_sub_field( 'facebook' ) ) {
						echo '<a href="' . esc_url( 'https://www.facebook.com/' . get_sub_field( 'facebook' ) ) . '" target="_blank"><i class="fab fa-facebook"></i></a>';
					}
					// GitHub
					if ( get_sub_field( 'github' ) ) {
						echo '<a href="' . 'https://github.com/' . get_sub_field( 'github' ) . '" target="_blank"><i class="fab fa-github"></i></a>';
					}
				?>
				</div>
				<?php endif; ?>
				<?php if ( get_sub_field( 'group' ) || get_sub_field( 'profile' ) ) : ?>
				<div class="speaker-profile">
				<?php
					// 所属
					if ( get_sub_field( 'group' ) ) {
						echo '<p class="speaker-group">' . __( 'Affiliation:', 'jawsugwp' );
						the_sub_field( 'group' );
						echo '</p>' . "\n";
					}
		
					// 自己紹介
					if ( get_sub_field( 'profile' ) ) {
						the_sub_field( 'profile' );
					}
				?>
				</div>
				<?php endif; ?>
				<?php
				echo '</div>' . "\n";

				endwhile;
			
			endif;
		?>

		<?php
			// 主な聴講者
			if ( get_field( 'target' ) ) {
				echo '<h2>' . __( 'Target', 'jawsugwp' ) . '</h2>' . "\n";
				the_field( 'target' );
			}

			// スライド資料
			if ( get_field( 'slide_url' ) ) {
				echo '<h2>' . __( 'Materials', 'jawsugwp' ) . '</h2>' . "\n";
				the_field( 'slide_url' );
			}

			// その他
			if ( get_field( 'other' ) ) {
				echo '<h2>' . __( 'Other', 'jawsugwp' ) . '</h2>' . "\n";
				the_field( 'other' );
			}
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jawsugwp' ),
				'after'  => '</div>',
			) );
		?>
		<?php do_action( 'jawsugwp_after_entry_content' ); ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'jawsugwp' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->

