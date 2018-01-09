<?php
/**
 * Hooks for ShareDaddy
 *
 * @package hametupack
 */

/**
 * Add share service
 *
 * @param array $services
 * @return array
 */
add_filter( 'sharing_services', function ( $services ) {
	$services['hatebu'] = \Hametuha\HametuPack\ShareDaddy\ShareHatebu::class;
	$services['line']   = \Hametuha\HametuPack\ShareDaddy\ShareLine::class;
	return $services;
} );

/**
 * Register styles
 */
add_action( 'init', function() {
	$asset_url = plugin_dir_url( __DIR__ ) . 'assets';
	wp_register_style( 'hametupack-share-daddy', "{$asset_url}/css/share-daddy-support.css", [], hametupack_version() );
} );

/**
 * Load asset in admin screen
 */
add_action( 'admin_enqueue_scripts', function( $page ) {
	wp_enqueue_style( 'hametupack-share-daddy' );
} );

/**
 * Show facebook app id form
 */
add_action( 'admin_init', function() {
	add_settings_field(
		'hametupack-fb-app-id-settings',
		__( 'Facebook App ID', 'hametupack' ),
		function () {
			?>
			<input type="text" id="hametupack-fb-app-id-settings" class="regular-text"
				   name="hametupack-fb-app-id-settings"
				   value="<?php echo esc_attr( get_option( 'hametupack-fb-app-id-settings' ) ); ?>"/>
			<p class="description"
			   style="width: auto;"><?php esc_html_e( 'Default facebook app ID(of WordPress.com) will be replaced by this app ID.', 'hametupack' ); ?></p>
			<?php
		},
		'sharing',
		'jetpack-twitter-cards-settings',
		array(
			'label_for' => 'hametupack-fb-app-id-setting',
		)
	);
} );

/**
 * Save option
 */
add_action( 'sharing_admin_update', function() {
	if ( wp_verify_nonce( $_POST['jetpack_twitter_cards_nonce'], 'jetpack-twitter-cards-settings' ) ) {
		update_option( 'hametupack-fb-app-id-settings', trim( ltrim( strip_tags( $_POST['hametupack-fb-app-id-settings'] ), '@' ) ) );
	}
} );

/**
 * Replace fb app id
 *
 * @param string $app_id
 * @return string
 */
add_filter( 'jetpack_sharing_facebook_app_id', function( $app_id ) {
	if ( $new_app_id = get_option( 'hametupack-fb-app-id-settings', '' ) ) {
		$app_id = $new_app_id;
	}
	return $app_id;
} );

