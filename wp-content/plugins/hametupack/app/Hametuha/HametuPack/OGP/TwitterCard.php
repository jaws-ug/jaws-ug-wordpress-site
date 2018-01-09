<?php
namespace Hametuha\HametuPack\OGP;

class TwitterCard {

	/**
	 *  This instance.
	 *
	 * @var null
	 */
	protected static $self = null;

	/**
	 * Constructor
	 */
	private function __construct() {
		// Determine card type.
		add_action( 'template_redirect', function () {
			if ( ! ( is_page() || is_single() || is_singular() ) ) {
				return;
			}
			$post = get_queried_object();
			if ( ! $this->requires_player( $post ) ) {
				return;
			}
			// This is singleton.
			add_filter( 'jetpack_open_graph_tags', [ $this, 'add_tags' ], 11 );
			// For Yoast.
			add_filter( 'wpseo_twitter_card_type', function( $type ) {
				return 'player';
			} );
			add_action( 'wpseo_twitter',  [ $this, 'yoast_output' ], 11 );
		}, 1000 );
		// Add query vars.
		add_filter( 'query_vars', function( $vars ) {
			$vars[] = 'hametupack-template';
			return $vars;
		} );

		// Add rewrite rules.
		add_filter( 'rewrite_rules_array', function ( $rules ) {
			$rules = array_merge( [
				'^hametupack/twitter-card/player/(\d+)/?$' => 'index.php?p=$matches[1]&hametupack-template=twitter-card',
			], $rules );
			return $rules;
		} );
		// Add customize query
		add_action( 'pre_get_posts', function( \WP_Query &$wp_query ) {
			if ( $wp_query->is_main_query() && 'twitter-card' == $wp_query->get( 'hametupack-template' ) ) {
				if ( ! $this->requires_player( $wp_query->get( 'p' ) ) ) {
					$wp_query->set_404();
				}
			}
		} );
		// Load template.
		add_filter( 'template_include', [ $this, 'load_template' ] );
	}

	/**
	 * Get media type of post.
	 *
	 * @param null|int|\WP_Post $post Post object.
	 *
	 * @return false|string
	 */
	public function get_media_type( $post = null ) {
		$post = get_post( $post );
		switch ( get_post_format( $post ) ) {
			case 'audio':
			case 'video':
				return get_post_format( $post );
				break;
			default:
				// If this is SSS, return episode type.
				return get_post_meta( $post->ID, 'episode_type', true ) ?: false;
				break;
		}
	}

	/**
	 * Get media URL.
	 *
	 * @param null|int|\WP_Post $post Post object.
	 *
	 * @return bool|string
	 */
	public function get_media_url( $post = null ) {
		$post = get_post( $post );
		switch ( get_post_format( $post ) ) {
			case 'audio':
			case 'video':
				$url = false;
				$query = new \WP_Query( [
					'post_type' => 'attachment',
					'post_parent' => $post->ID,
					'posts_per_page' => 1,
					'post_mime_type' => get_post_format( $post ),
					'orderby' => [
						'menu_order' => 'desc',
					],
				] );
				while ( $query->have_posts() ) {
					$query->the_post();
					$url = get_the_guid();
				}
				wp_reset_postdata();
				return $url;
				break;
			default:
				// If this is SSS, return episode type.
				return get_post_meta( $post->ID, 'audio_file', true ) ?: false;
				break;
		}
	}

	/**
	 * Get mime_type
	 *
	 * @param string $url URL of attachment file.
	 *
	 * @return string
	 */
	public function get_mimetype_from_url( $url ) {
		global $wpdb;
		$query = <<<SQL
			SELECT post_mime_type FROM {$wpdb->posts}
			WHERE post_type = 'attachment'
			  AND guid = %s
			LIMIT 1
SQL;
		return (string) $wpdb->get_var( $wpdb->prepare( $query, $url ) );
	}

	/**
	 * Get player cards
	 *
	 * @param null|int|\WP_Post $post Post object.
	 *
	 * @return string
	 */
	public function get_card_url( $post = null ) {
		$post = get_post( $post );
		if ( get_option( 'rewrite_rules' ) ) {
			return home_url( "/hametupack/twitter-card/player/{$post->ID}" );
		} else {
			return add_query_arg( [
				'hametupack_twitter_card' => $post->ID,
			], home_url() );
		}
	}

	/**
	 * Detect if current post requires player
	 *
	 * @param null|int|\WP_Post $post Post object.
	 *
	 * @return bool
	 */
	public function requires_player( $post = null ) {
		// Is this post format?
		if ( false === array_search( $this->get_media_type( $post ), [ 'audio', 'video' ] ) ) {
			return false;
		}
		// Does this have actual file?
		return $this->get_media_url( $post ) ? true : false;
	}

	public function get_player_dimension( $post, $type ) {
		/**
		 * Get dimension for iframe
		 *
		 * @param array    $size Array fo [$width, $height ]
		 * @param \WP_Post $post WP_Post object
		 * @param string   $type audio or video
		 */
		return apply_filters( 'hametupack_media_dimension', [ 480, 'audio' == $type ? 200 : 320  ], $post, $type );
	}

	/**
	 * Overrides Yoast's OGP who overrides jetpack.
	 */
	public function yoast_output() {
		$post = get_queried_object();
		$url  = $this->get_media_url( $post );
		$type = $this->get_media_type( $post );
		list( $width, $height ) = $this->get_player_dimension( $post, $type );
		?>
		<meta name="twitter:player" content="<?= $this->get_card_url( $post ) ?>" />
		<meta name="twitter:player:width" content="<?= esc_attr( $width ) ?>" />
		<meta name="twitter:player:height" content="<?= esc_attr( $height ) ?>" />
		<meta name="twitter:player:stream" content="<?= esc_url( $url ) ?>" />
		<meta name="twitter:player:stream:content_type" content="<?= esc_attr( $this->get_mimetype_from_url( $url ) ) ?>" />
		<?php
	}

	/**
	 * Detect if tag should be replaced.
	 *
	 * @param array $og_tags Jetpack's default card.
	 * @return array
	 */
	public function add_tags( $og_tags ) {
		$post = get_queried_object();
		// Let's add tags for this!
		$url  = $this->get_media_url( $post );
		$type = $this->get_media_type( $post );
		list( $width, $height ) = $this->get_player_dimension( $post, $type );
		$og_tags['twitter:card'] = 'player';
		$og_tags['twitter:player'] = $this->get_card_url( $post );
		$og_tags['twitter:player:width'] = $width;
		$og_tags['twitter:player:height'] = $height;
		$og_tags['twitter:player:stream'] = $url;
		$og_tags['twitter:player:stream:content_type'] = $this->get_mimetype_from_url( $url );
		return $og_tags;
	}

	/**
	 * Get file template for player card.
	 *
	 * @param string $template
	 *
	 * @return string
	 */
	public function load_template( $template ) {
		if ( ! is_404() && 'twitter-card' == get_query_var( 'hametupack-template' ) ) {
			$post = get_queried_object();
			$type = $this->get_media_type( $post );
			$file_name = "player-card-{$type}.php";
			$file = '';
			foreach ( [
				dirname( dirname( dirname( dirname( __DIR__ ) ) ) ) . '/template-parts',
				get_template_directory() . '/template-parts/hametupack',
				get_stylesheet_directory() . '/template-parts/hametupack',
			] as $base ) {
				$path = trailingslashit( $base ) . $file_name;
				if ( file_exists( $path ) ) {
					$file = $path;
				}
			}
			/**
			 * hametupack_card_template
			 *
			 * @param string   $file File path for template.
			 * @param \WP_Post $post Post object.
			 * @param string   $type Media type.
			 */
			$file = apply_filters( 'hametupack_card_template', $file, $post, $type );
			if ( $file ) {
				$template = $file;
			}
		}
		return $template;
	}

	/**
	 * Get instance
	 *
	 * @return TwitterCard
	 */
	public static function get_instance() {
		if ( is_null( self::$self ) ) {
			self::$self = new self();
		}
		return self::$self;
	}
}
