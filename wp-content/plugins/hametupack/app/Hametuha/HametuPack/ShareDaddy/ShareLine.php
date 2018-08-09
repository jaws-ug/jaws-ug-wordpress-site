<?php

namespace Hametuha\HametuPack\ShareDaddy;


/**
 * Add share daddy to Line
 *
 * @package hametupack
 */
class ShareLine extends AbstractShare {

	protected $id = 'line';

	public $shortname = 'line';

	public $genericon = '\f469';

	protected $open_link_in_new = true;

	public $smart = true;

	public function __construct( $id, array $settings ) {
		parent::__construct( $id, $settings );

		if ( 'official' == $this->button_style ) {
			$this->smart = true;
		} else {
			$this->smart = false;
		}
	}

	/**
	 * @return string
	 */
	public function get_name() {
		return __( 'LINE', 'hametupack' );
	}

	/**
	 * Get permalink
	 *
	 * @param \WP_Post $post
	 *
	 * @return string
	 */
	public function get_display( $post ) {
		$url = get_permalink( $post );
		$title = __( 'Send this entry via LINE', 'hametupack' );
		if ( $this->smart ) {
			ob_start();
			?>
			<div class="line-it-button" data-lang="ja" data-type="share-a" data-url="<?= esc_attr( $url ) ?>" style="display: none;"></div>
			<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
			<?php
			$link = ob_get_contents();
			ob_end_clean();
			return $link;
		} else {
			$line_url = sprintf( 'https://line.me/R/msg/text/?%s', rawurlencode( $url ) );
			if ( 'icon-text' == $this->button_style ) {
				$label = _x( 'Send', 'share_to', 'hametupack' );
			} else {
				$label = _x( 'Send to LINE', 'share_to', 'hametupack' );
			}
			wp_enqueue_style( 'hametupack-share-daddy' );
			return $this->get_link( $line_url, $label, $title, '', 'sharing-line-' . $post->ID );
		}
	}
}

