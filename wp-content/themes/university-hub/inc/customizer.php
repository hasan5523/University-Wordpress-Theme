<?php
/**
 * Theme Customizer.
 *
 * @package University_Hub
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function university_hub_customize_register( $wp_customize ) {

	// Load custom controls.
	include get_template_directory() . '/inc/customizer/control.php';

	// Register custom control types.
	$wp_customize->register_control_type( 'University_Hub_Heading_Control' );
	$wp_customize->register_control_type( 'University_Hub_Message_Control' );
	$wp_customize->register_control_type( 'University_Hub_Dropdown_Taxonomies_Control' );
	$wp_customize->register_control_type( 'University_Hub_Dropdown_Sidebars_Control' );
	$wp_customize->register_control_type( 'University_Hub_Section_Manager_Control' );

	// Register custom section types.
	$wp_customize->register_section_type( 'University_Hub_Customize_Section_Upsell' );

	// Load customize helpers.
	include get_template_directory() . '/inc/helper/options.php';

	// Load customize sanitize.
	include get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize callback.
	include get_template_directory() . '/inc/customizer/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Load customize option.
	include get_template_directory() . '/inc/customizer/option.php';

	// Load home sections option.
	include get_template_directory() . '/inc/customizer/home-sections.php';

	// Load slider customize option.
	require get_template_directory() . '/inc/customizer/slider.php';

	// Modify default customizer options.
	$wp_customize->get_control( 'background_color' )->description = __( 'Note: Background Color is applicable only if no image is set as Background Image.', 'university-hub' );

	// Register sections.
	$wp_customize->add_section(
		new University_Hub_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'University Hub Pro', 'university-hub' ),
				'pro_text' => esc_html__( 'Buy Pro', 'university-hub' ),
				'pro_url'  => 'https://themepalace.com/downloads/university-hub-pro/',
				'priority'  => 1,
			)
		)
	);

}
add_action( 'customize_register', 'university_hub_customize_register' );

/**
 * Customizer partials.
 *
 * @since 1.0.0
 */
function university_hub_customizer_partials( WP_Customize_Manager $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
		$wp_customize->get_setting( 'theme_options[copyright_text]' )->transport = 'refresh';
		return;

	}

	// Load customizer partials callback.
	include get_template_directory() . '/inc/customizer/partials.php';

	// Partial blogname.
	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'university_hub_customize_partial_blogname',
		 )
	);

	// Partial blogdescription.
	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'university_hub_customize_partial_blogdescription',
		 )
	);

	// Partial copyright_text.
	$wp_customize->selective_refresh->add_partial(
		'copyright_text', array(
		'selector'            => '#colophon .copyright',
		'container_inclusive' => false,
		'settings'            => array( 'theme_options[copyright_text]' ),
		'render_callback'     => 'university_hub_render_partial_copyright_text',
		 )
	);

}

add_action( 'customize_register', 'university_hub_customizer_partials', 99 );

/**
 * Register customizer controls scripts.
 *
 * @since 1.0.0
 */
function university_hub_customize_controls_register_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_register_script( 'university-hub-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'jquery', 'customize-controls' ), '1.0.1', true );
	wp_register_style( 'university-hub-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'university_hub_customize_controls_register_scripts', 0 );
