<?php
/**
 * Theme Options related to slider.
 *
 * @package University_Hub
 */

$default = university_hub_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_slider_panel',
	array(
	'title'      => __( 'Featured Slider', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Slider Type Section.
$wp_customize->add_section( 'section_theme_slider_type',
	array(
	'title'      => __( 'Slider Type', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_status.
$wp_customize->add_setting( 'theme_options[featured_slider_status]',
	array(
	'default'           => $default['featured_slider_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_status]',
	array(
	'label'    => __( 'Enable Slider On', 'university-hub' ),
	'section'  => 'section_theme_slider_type',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => university_hub_get_featured_slider_content_options(),
	)
);
// Setting featured_slider_type.
$wp_customize->add_setting( 'theme_options[featured_slider_type]',
	array(
	'default'           => $default['featured_slider_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_type]',
	array(
	'label'           => __( 'Select Slider Type', 'university-hub' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'select',
	'priority'        => 100,
	'choices'         => university_hub_get_featured_slider_type(),
	'active_callback' => 'university_hub_is_featured_slider_active',
	)
);

// Setting featured_slider_number.
$wp_customize->add_setting( 'theme_options[featured_slider_number]',
	array(
	'default'           => $default['featured_slider_number'],
	'capability'        => 'edit_theme_options',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'university_hub_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_number]',
	array(
	'label'           => __( 'No of slides', 'university-hub' ),
	'description'     => __( 'Enter number between 1 and 20. Save and refresh the page if No of Slides is changed.', 'university-hub' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'number',
	'priority'        => 100,
	'active_callback' => 'university_hub_is_featured_slider_active',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);

$featured_slider_number = absint( university_hub_get_option( 'featured_slider_number' ) );

if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
		$wp_customize->add_setting( "theme_options[featured_slider_page_$i]",
			array(
			'default'           => isset( $default[ 'featured_slider_page_' .$i ] ) ? $default[ 'featured_slider_page_' .$i ] : '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'university_hub_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control( "theme_options[featured_slider_page_$i]",
			array(
			'label'           => __( 'Featured Page', 'university-hub' ) . ' - ' . $i,
			'section'         => 'section_theme_slider_type',
			'type'            => 'dropdown-pages',
			'priority'        => 100,
			'active_callback' => 'university_hub_is_featured_page_slider_active',
			)
		);
	} // End for loop.
}

// Setting featured_slider_read_more_text.
$wp_customize->add_setting( 'theme_options[featured_slider_read_more_text]',
	array(
	'default'           => $default['featured_slider_read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_read_more_text]',
	array(
	'label'           => __( 'Read More Text', 'university-hub' ),
	'section'         => 'section_theme_slider_type',
	'type'            => 'text',
	'priority'        => 100,
	'active_callback' => 'university_hub_is_featured_slider_active',
	)
);


// Slider Options Section.
$wp_customize->add_section( 'section_theme_slider_options',
	array(
	'title'      => __( 'Slider Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_transition_effect.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_effect]',
	array(
	'default'           => $default['featured_slider_transition_effect'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select_liberal',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_effect]',
	array(
	'label'    => __( 'Transition Effect', 'university-hub' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => university_hub_get_featured_slider_transition_effects(),
	)
);
// Setting featured_slider_transition_delay.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_delay]',
	array(
	'default'           => $default['featured_slider_transition_delay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_delay]',
	array(
	'label'       => __( 'Transition Delay', 'university-hub' ),
	'description' => __( 'in seconds', 'university-hub' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_transition_duration.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_duration]',
	array(
	'default'           => $default['featured_slider_transition_duration'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_duration]',
	array(
	'label'       => __( 'Transition Duration', 'university-hub' ),
	'description' => __( 'in seconds', 'university-hub' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_enable_caption.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_caption]',
	array(
	'default'           => $default['featured_slider_enable_caption'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_caption]',
	array(
	'label'    => __( 'Enable Caption', 'university-hub' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_arrow.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_arrow]',
	array(
	'default'           => $default['featured_slider_enable_arrow'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_arrow]',
	array(
	'label'    => __( 'Enable Arrow', 'university-hub' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_pager.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_pager]',
	array(
	'default'           => $default['featured_slider_enable_pager'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_pager]',
	array(
	'label'    => __( 'Enable Pager', 'university-hub' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_autoplay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'default'           => $default['featured_slider_enable_autoplay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'label'    => __( 'Enable Autoplay', 'university-hub' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
