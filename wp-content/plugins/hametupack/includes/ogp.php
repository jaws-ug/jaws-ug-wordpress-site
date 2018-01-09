<?php
/**
 * OGP related features
 */



/**
 * Display
 */
add_action( 'admin_init', function() {
	add_settings_field(
		'hametupack-show-player-card',
		__( 'Twitter Player Card', 'hametupack' ),
		function () {
			foreach ( [
				'1' => __( 'Use player card if possible.', 'hametupack' ),
				'' => __( 'No player card.', 'hametupack' ),
			] as $value => $label ) {
				?>
				<label style="display: block; margin: 5px 0">
					<input type="radio" class="regular-text" name="hametupack-show-player-card"
						   value="<?php echo esc_attr( $value ) ?>"
						   <?php checked( $value == get_option( 'hametupack-show-player-card', '1' ) ) ?> />
					<?php echo esc_html( $label ) ?>
				</label>
				<?php
			}
			?>
			<p class="description"
			   style="width: auto;">
				<?php echo wp_kses( __( 'For more detail for twitter cards, see <a href="https://dev.twitter.com/cards/types/player" target="_blank">document</a>.', 'hametupack' ), [
						'a' => [
							'href' => true,
							'target' => '_blank',
						],
				] ); ?>
			</p>
			<?php
		},
		'sharing',
		'jetpack-twitter-cards-settings'
	);
} );


/**
 * Save option
 */
add_action( 'sharing_admin_update', function() {
	if ( wp_verify_nonce( $_POST['jetpack_twitter_cards_nonce'], 'jetpack-twitter-cards-settings' ) ) {
		update_option( 'hametupack-show-player-card', $_POST['hametupack-show-player-card'] );
	}
} );

/**
 * If setting is true, display twitter card if possible.
 */
add_action( 'init', function() {
	if ( get_option( 'hametupack-show-player-card', 1 ) ) {
		\Hametuha\HametuPack\OGP\TwitterCard::get_instance();
	}
} );
