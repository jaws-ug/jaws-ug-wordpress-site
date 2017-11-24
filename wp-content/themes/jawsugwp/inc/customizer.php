<?php
/**
 * JAWS-UG WordPress Theme Customizer.
 *
 * @package JAWS_UG_WP
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jawsugwp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	/**
	 * Theme options.
	 */
	$wp_customize->add_section( 'jawsugwp_theme_options', array(
		'title'    => __( 'Theme Options', 'jawsugwp' ),
		'priority'   => 160,
	) );

	// Footer section use
	$wp_customize->add_setting( 'footer_section_view', array(
		'default'           => false,
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_section_view', array(
			'label'    => __( 'Footer Section View', 'jawsugwp' ),
			'section'  => 'jawsugwp_theme_options',
			'settings' => 'footer_section_view',
			'type'     => 'checkbox',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footer_section_view', array(
			'selector'            => '#jawsugwp-contact-box',
		)
	);

	// Footer section title
	$wp_customize->add_setting( 'footer_section_title', array(
		'default'           => sprintf(
				esc_html__( 'To participate in the JAWS DAYS %d', 'jawsugwp' ),
				2018
			),
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_section_title', array(
			'label'    => __( 'Footer Section Title', 'jawsugwp' ),
			'section'  => 'jawsugwp_theme_options',
			'settings' => 'footer_section_title',
			'type'     => 'text',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footer_section_title', array(
			'selector'            => '#jawsugwp-contact-title',
		)
	);

	// Page link
	$wp_customize->add_setting( 'footer_section_link', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_section_link', array(
			'label'    => __( 'Button Link Page', 'jawsugwp' ),
			'section'  => 'jawsugwp_theme_options',
			'settings' => 'footer_section_link',
			'type'     => 'dropdown-pages',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footer_section_link', array(
			'selector'            => '#jawsugwp-contact-btn-link',
		)
	);

	// Button text
	$wp_customize->add_setting( 'footer_section_btn', array(
		'default'           => __( 'Tickets', 'jawsugwp' ),
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_section_btn', array(
			'label'    => __( 'Button Text', 'jawsugwp' ),
			'section'  => 'jawsugwp_theme_options',
			'settings' => 'footer_section_btn',
			'type'     => 'text',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footer_section_btn', array(
			'selector'            => '#jawsugwp-contact-btn-text',
		)
	);

	// Other text
	$wp_customize->add_setting( 'footer_section_other', array(
		'default'           => '',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_section_other', array(
			'label'    => __( 'Other Text', 'jawsugwp' ),
			'section'  => 'jawsugwp_theme_options',
			'settings' => 'footer_section_other',
			'type'     => 'textarea',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'footer_section_other', array(
			'selector'            => '#jawsugwp-contact-other-text',
		)
	);
}
add_action( 'customize_register', 'jawsugwp_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jawsugwp_customize_preview_js() {
	wp_enqueue_script( 'jawsugwp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'jawsugwp_customize_preview_js' );

/**
 * Custom background callback function.
 */
function jawsugwp_custom_background_cb() {
    // $background is the saved custom image, or the default image.
    $background = set_url_scheme( get_background_image() );
 
    // $color is the saved custom color.
    // A default has to be specified in style.css. It will not be printed here.
    $color = get_background_color();
 
    if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
        $color = false;
    }
 
    if ( ! $background && ! $color ) {
        if ( is_customize_preview() ) {
            echo '<style type="text/css" id="custom-background-css"></style>';
        }
        return;
    }
 
    $style = $color ? "background-color: #$color;" : '';
 
    if ( $background ) {
        $image = ' background-image: url("' . esc_url_raw( $background ) . '");';
 
        // Background Position.
        $position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
        $position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );
 
        if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
            $position_x = 'left';
        }
 
        if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
            $position_y = 'top';
        }
 
        $position = " background-position: $position_x $position_y;";
 
        // Background Size.
        $size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );
 
        if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
            $size = 'auto';
        }
 
        $size = " background-size: $size;";
 
        // Background Repeat.
        $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
 
        if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
            $repeat = 'repeat';
        }
 
        $repeat = " background-repeat: $repeat;";
 
        // Background Scroll.
        $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
 
        if ( 'fixed' !== $attachment ) {
            $attachment = 'scroll';
        }
 
        $attachment = " background-attachment: $attachment;";
 
        $style .= $image . $position . $size . $repeat . $attachment;
    }
?>
<style type="text/css" id="custom-background-css">
body.custom-background.home .site-content { <?php echo trim( $style ); ?> }
</style>
<?php
}