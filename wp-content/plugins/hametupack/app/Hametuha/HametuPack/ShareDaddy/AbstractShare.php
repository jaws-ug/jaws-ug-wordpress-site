<?php

namespace Hametuha\HametuPack\ShareDaddy;

/**
 * Abstract layer of hametupack
 *
 * @package Hametuha\HametuPack\ShareDaddy
 */
abstract class AbstractShare extends \Sharing_Source {
	
	/**
	 * Constructor
	 *
	 * @param $id
	 * @param array $settings
	 */
	public function __construct( $id, array $settings ) {
		parent::__construct( $id, $settings );
		add_filter( 'hametupack_amp_share_button', [ $this, 'filter_amp_button' ], 10, 2 );
	}
	
	/**
	 * Filter markup
	 *
	 * @param string $markup
	 * @param string $id
	 * @return string
	 */
	public function filter_amp_button( $markup, $id ) {
		if ( $id !== $this->id ) {
			return $markup;
		}
		$atts = '';
		foreach ( $this->amp_share_attributes() as $key => $val ) {
			$atts .= sprintf( ' %s="%s"', $key, esc_attr( $val ) );
		}
		return <<<HTML
<amp-social-share type="{$this->id}" width="60" height="44"{$atts}></amp-social-share>
HTML;
	}
	
	/**
	 * Override URL.
	 *
	 * @return array
	 */
	protected function amp_share_attributes() {
		return [];
	}
}