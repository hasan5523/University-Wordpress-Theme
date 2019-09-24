<?php
/**
 * Home Sections Options.
 *
 * @package University_Hub
 */

$default = university_hub_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_home_sections_panel',
	array(
		'title'      => __( 'Homepage Sections', 'university-hub' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		)
);

// Home Section Manager.
$wp_customize->add_section( 'section_home_sections_manager',
	array(
		'title'      => __( 'Manage Sections', 'university-hub' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting homepage_sections.
$wp_customize->add_setting( 'theme_options[homepage_sections]',
	array(
		'default'           => $default['homepage_sections'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_homepage_sections',
		)
);

$wp_customize->add_control(
	new University_Hub_Section_Manager_Control(
		$wp_customize,
		'theme_options[homepage_sections]',
		array(
			'label'    => esc_html__( 'Toggle sections', 'university-hub' ),
			'section'  => 'section_home_sections_manager',
			'settings' => 'theme_options[homepage_sections]',
			'priority' => 1,
			'choices'  => university_hub_get_home_sections_options(),
			)
	)
);

// Home Section News and Events.
$wp_customize->add_section( 'section_home_news_and_events',
	array(
		'title'      => __( 'News and Events', 'university-hub' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting news_and_events_ntitle.
$wp_customize->add_setting( 'theme_options[news_and_events_ntitle]',
	array(
		'default'           => $default['news_and_events_ntitle'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[news_and_events_ntitle]',
	array(
		'label'    => __( 'News Title', 'university-hub' ),
		'section'  => 'section_home_news_and_events',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting news_and_events_nnumber.
$wp_customize->add_setting( 'theme_options[news_and_events_nnumber]',
	array(
		'default'           => $default['news_and_events_nnumber'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[news_and_events_nnumber]',
	array(
		'label'       => __( 'No of News', 'university-hub' ),
		'section'     => 'section_home_news_and_events',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
		)
);

// Setting news_and_events_ncategory.
$wp_customize->add_setting( 'theme_options[news_and_events_ncategory]',
	array(
		'default'           => $default['news_and_events_ncategory'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new University_Hub_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[news_and_events_ncategory]',
		array(
			'label'    => __( 'News Category', 'university-hub' ),
			'section'  => 'section_home_news_and_events',
			'settings' => 'theme_options[news_and_events_ncategory]',
			'priority' => 100,
		)
	)
);

// Setting news_and_events_etitle.
$wp_customize->add_setting( 'theme_options[news_and_events_etitle]',
	array(
		'default'           => $default['news_and_events_etitle'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[news_and_events_etitle]',
	array(
		'label'    => __( 'Events Title', 'university-hub' ),
		'section'  => 'section_home_news_and_events',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting news_and_events_enumber.
$wp_customize->add_setting( 'theme_options[news_and_events_enumber]',
	array(
		'default'           => $default['news_and_events_enumber'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[news_and_events_enumber]',
	array(
		'label'       => __( 'No of Events', 'university-hub' ),
		'section'     => 'section_home_news_and_events',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
		)
);

// Setting news_and_events_ecategory.
$wp_customize->add_setting( 'theme_options[news_and_events_ecategory]',
	array(
		'default'           => $default['news_and_events_ecategory'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new University_Hub_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[news_and_events_ecategory]',
		array(
			'label'    => __( 'Events Category', 'university-hub' ),
			'section'  => 'section_home_news_and_events',
			'settings' => 'theme_options[news_and_events_ecategory]',
			'priority' => 100,
		)
	)
);

// Home Section Call To Action.
$wp_customize->add_section( 'section_home_call_to_action',
	array(
		'title'      => __( 'Call To Action', 'university-hub' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting cta_title.
$wp_customize->add_setting( 'theme_options[cta_title]',
	array(
		'default'           => $default['cta_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[cta_title]',
	array(
		'label'    => __( 'Title', 'university-hub' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting cta_description.
$wp_customize->add_setting( 'theme_options[cta_description]',
	array(
		'default'           => $default['cta_description'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[cta_description]',
	array(
		'label'    => __( 'Subtitle', 'university-hub' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting cta_primary_button_text.
$wp_customize->add_setting( 'theme_options[cta_primary_button_text]',
	array(
		'default'           => $default['cta_primary_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[cta_primary_button_text]',
	array(
		'label'    => __( 'Primary Button Text', 'university-hub' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting cta_primary_button_url.
$wp_customize->add_setting( 'theme_options[cta_primary_button_url]',
	array(
		'default'           => $default['cta_primary_button_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		)
);
$wp_customize->add_control( 'theme_options[cta_primary_button_url]',
	array(
		'label'    => __( 'Primary Button URL', 'university-hub' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting cta_secondary_button_text.
$wp_customize->add_setting( 'theme_options[cta_secondary_button_text]',
	array(
		'default'           => $default['cta_secondary_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[cta_secondary_button_text]',
	array(
		'label'    => __( 'Secondary Button Text', 'university-hub' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting cta_secondary_button_url.
$wp_customize->add_setting( 'theme_options[cta_secondary_button_url]',
	array(
		'default'           => $default['cta_secondary_button_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		)
);
$wp_customize->add_control( 'theme_options[cta_secondary_button_url]',
	array(
		'label'    => __( 'Secondary Button URL', 'university-hub' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Home Section Latest News.
$wp_customize->add_section( 'section_home_latest_news',
	array(
		'title'      => __( 'Latest News', 'university-hub' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting latest_news_title.
$wp_customize->add_setting( 'theme_options[latest_news_title]',
	array(
		'default'           => $default['latest_news_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_title]',
	array(
		'label'    => __( 'Title', 'university-hub' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting latest_news_layout.
$wp_customize->add_setting( 'theme_options[latest_news_layout]',
	array(
		'default'           => $default['latest_news_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_select',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_layout]',
	array(
		'label'    => __( 'Layout', 'university-hub' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => university_hub_get_numbers_dropdown_options( 1, 2, __( 'Layout', 'university-hub' ) . ' ' ),
		)
);

// Setting latest_news_column.
$wp_customize->add_setting( 'theme_options[latest_news_column]',
	array(
		'default'           => $default['latest_news_column'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_select',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_column]',
	array(
		'label'    => __( 'Columns', 'university-hub' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => university_hub_get_numbers_dropdown_options( 3, 4 ),
		)
);

// Setting latest_news_number.
$wp_customize->add_setting( 'theme_options[latest_news_number]',
	array(
		'default'           => $default['latest_news_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_number]',
	array(
		'label'       => __( 'No of Blocks', 'university-hub' ),
		'section'     => 'section_home_latest_news',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
		)
);

// Setting latest_news_category.
$wp_customize->add_setting( 'theme_options[latest_news_category]',
	array(
		'default'           => $default['latest_news_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new University_Hub_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[latest_news_category]',
		array(
			'label'    => __( 'Select Category', 'university-hub' ),
			'section'  => 'section_home_latest_news',
			'settings' => 'theme_options[latest_news_category]',
			'priority' => 100,
		)
	)
);

// Setting latest_news_featured_image.
$wp_customize->add_setting( 'theme_options[latest_news_featured_image]',
	array(
		'default'           => $default['latest_news_featured_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_select',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_featured_image]',
	array(
		'label'    => __( 'Image Size', 'university-hub' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => university_hub_get_image_sizes_options( false ),
		)
);

// Setting latest_news_excerpt_length.
$wp_customize->add_setting( 'theme_options[latest_news_excerpt_length]',
	array(
	'default'           => $default['latest_news_excerpt_length'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[latest_news_excerpt_length]',
	array(
	'label'       => __( 'Excerpt Length', 'university-hub' ),
	'description' => __( 'in words', 'university-hub' ),
	'section'     => 'section_home_latest_news',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 0, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);
