<?php

namespace Hametuha\HametuPack\ShareDaddy;


/**
 * Add share daddy to hatebu
 *
 * @package hametupack
 */
class ShareHatebu extends \Sharing_Source {

	protected $id = 'hatebu';

	public $shortname = 'hatebu';

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
		return __( 'Hatebu', 'hametupack' );
	}

	/**
	 * Get permalink
	 *
	 * @param \WP_Post $post
	 *
	 * @return string
	 */
	public function get_display( $post ) {
		$url = sprintf( 'http://b.hatena.ne.jp/entry/%s', preg_replace_callback( '#^(https?)://#u', function ( $match ) {
			return 'https' == $match[1] ? 's/' : '';
		}, get_permalink( $post ) ) );
		$title = __( 'Add this entry to hatena bookmark', 'hametupack' );
		if ( $this->smart ) {
			ob_start();
			?>
			<a href="<?= $url ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label-counter"
			   data-hatena-bookmark-lang="ja" title="<?= esc_attr( $title ) ?>">
				<img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png"
					 alt="<?= esc_attr( $title ) ?>"
					 width="20" height="20" style="border: none;"/>
			</a>
			<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8"
					async="async"></script>
			<?php
			$link = ob_get_contents();
			ob_end_clean();

			return $link;
		} else {
			if ( 'icon-text' == $this->button_style ) {
				$label = _x( 'Bookmark', 'share_to', 'hametupack' );
			} else {
				$label = _x( 'Hatena Bookmark', 'share_to', 'hametupack' );
			}
			wp_enqueue_style( 'hametupack-share-daddy' );
			return $this->get_link( $url, $label, $title, '', 'sharing-hatebu-' . $post->ID );
		}
	}
}

