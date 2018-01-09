<?php
/*
 * This template is rendered as twitter card.
 *
 * $twitter object is utility class for generating media tags.
 */
$twitter = \Hametuha\HametuPack\OGP\TwitterCard::get_instance();
the_post();
$url = $twitter->get_media_url();
list( $width, $height ) = $twitter->get_player_dimension( get_post(), $twitter->get_media_type() );
?><!DOCTYPE html>
<html>
<head>
	<meta charset="<?php get_bloginfo( 'charset' ) ?>" />
	<title><?php the_title() ?></title>

	<style type="text/css">
		body, html {
			margin: 0;
		}
		.container {
			width: <?php echo (int) $width ?>px;
		}
		video {
			width: 100%;
			max-width: <?php echo (int) $width ?>px;
			height: auto;
		}
	</style>
</head>
<body>


<div class="container">

	<video controls>
		<source src="<?php echo esc_url( $url ) ?>"
		        type="<?php echo esc_attr( $twitter->get_mimetype_from_url( $url ) ) ?>">
		<?php esc_html_e( 'Your browser does not support the audio tag.', 'hametupack' ); ?>
	</video>

</div>

</body>
</html>
