<?php
/**
 * Theme Options.
 *
 * @package University_Hub
 */

$default = university_hub_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => __( 'Theme Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section( 'section_header',
	array(
	'title'      => __( 'Header Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting( 'theme_options[show_title]',
	array(
	'default'           => $default['show_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_title]',
	array(
	'label'    => __( 'Show Site Title', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting show_tagline.
$wp_customize->add_setting( 'theme_options[show_tagline]',
	array(
	'default'           => $default['show_tagline'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_tagline]',
	array(
	'label'    => __( 'Show Tagline', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting show_ticker.
$wp_customize->add_setting( 'theme_options[show_ticker]',
	array(
	'default'           => $default['show_ticker'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_ticker]',
	array(
	'label'    => __( 'Show News Ticker', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting ticker_title.
$wp_customize->add_setting( 'theme_options[ticker_title]',
	array(
		'default'           => $default['ticker_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[ticker_title]',
	array(
		'label'           => __( 'Ticker Title', 'university-hub' ),
		'section'         => 'section_header',
		'type'            => 'text',
		'priority'        => 100,
		'active_callback' => 'university_hub_is_news_ticker_active',
	)
);

// Setting ticker_category.
$wp_customize->add_setting( 'theme_options[ticker_category]',
	array(
		'default'           => $default['ticker_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new University_Hub_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[ticker_category]',
		array(
			'label'           => __( 'Ticker Category', 'university-hub' ),
			'section'         => 'section_header',
			'settings'        => 'theme_options[ticker_category]',
			'priority'        => 100,
			'active_callback' => 'university_hub_is_news_ticker_active',
		)
	)
);

// Setting ticker_number.
$wp_customize->add_setting( 'theme_options[ticker_number]',
	array(
		'default'           => $default['ticker_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[ticker_number]',
	array(
		'label'           => __( 'Number of Posts', 'university-hub' ),
		'section'         => 'section_header',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'university_hub_is_news_ticker_active',
		'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);

// Setting contact_number.
$wp_customize->add_setting( 'theme_options[contact_number]',
	array(
	'default'           => $default['contact_number'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[contact_number]',
	array(
	'label'    => __( 'Contact Number', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting contact_email.
$wp_customize->add_setting( 'theme_options[contact_email]',
	array(
	'default'           => $default['contact_email'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_email',
	)
);
$wp_customize->add_control( 'theme_options[contact_email]',
	array(
	'label'    => __( 'Contact Email', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting contact_address_1.
$wp_customize->add_setting( 'theme_options[contact_address_1]',
	array(
	'default'           => $default['contact_address_1'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[contact_address_1]',
	array(
	'label'    => __( 'Contact Address 1', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting contact_address_2.
$wp_customize->add_setting( 'theme_options[contact_address_2]',
	array(
	'default'           => $default['contact_address_2'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[contact_address_2]',
	array(
	'label'    => __( 'Contact Address 2', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting show_social_in_header.
$wp_customize->add_setting( 'theme_options[show_social_in_header]',
	array(
	'default'           => $default['show_social_in_header'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_social_in_header]',
	array(
	'label'    => __( 'Show Social Icons', 'university-hub' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

$wp_customize->add_setting( 'theme_options[search_in_header]',
	array(
		'default'           => $default['search_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[search_in_header]',
	array(
		'label'    => __( 'Enable Search Form', 'university-hub' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
	'title'      => __( 'Layout Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'theme_options[global_layout]',
	array(
	'default'           => $default['global_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[global_layout]',
	array(
	'label'    => __( 'Global Layout', 'university-hub' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => university_hub_get_global_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_layout.
$wp_customize->add_setting( 'theme_options[archive_layout]',
	array(
	'default'           => $default['archive_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_layout]',
	array(
	'label'    => __( 'Archive Layout', 'university-hub' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => university_hub_get_archive_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_image.
$wp_customize->add_setting( 'theme_options[archive_image]',
	array(
	'default'           => $default['archive_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image]',
	array(
	'label'    => __( 'Image in Archive', 'university-hub' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => university_hub_get_image_sizes_options( true, array( 'disable', 'thumbnail', 'medium', 'large' ), false ),
	'priority' => 100,
	)
);
// Setting archive_image_alignment.
$wp_customize->add_setting( 'theme_options[archive_image_alignment]',
	array(
	'default'           => $default['archive_image_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image_alignment]',
	array(
	'label'           => __( 'Image Alignment in Archive', 'university-hub' ),
	'section'         => 'section_layout',
	'type'            => 'select',
	'choices'         => university_hub_get_image_alignment_options(),
	'priority'        => 100,
	'active_callback' => 'university_hub_is_image_in_archive_active',
	)
);
// Setting single_image.
$wp_customize->add_setting( 'theme_options[single_image]',
	array(
	'default'           => $default['single_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[single_image]',
	array(
	'label'    => __( 'Image in Single Post/Page', 'university-hub' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => university_hub_get_image_sizes_options( true, array( 'disable', 'large' ), false ),
	'priority' => 100,
	)
);

// Home Page Section.
$wp_customize->add_section( 'section_home_page',
	array(
	'title'      => __( 'Home Page Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);
// Setting home_content_status.
$wp_customize->add_setting( 'theme_options[home_content_status]',
	array(
	'default'           => $default['home_content_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[home_content_status]',
	array(
	'label'       => __( 'Show Home Content', 'university-hub' ),
	'description' => __( 'Check this to show page content in Home page.', 'university-hub' ),
	'section'     => 'section_home_page',
	'type'        => 'checkbox',
	'priority'    => 100,
	)
);

// Pagination Section.
$wp_customize->add_section( 'section_pagination',
	array(
	'title'      => __( 'Pagination Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'theme_options[pagination_type]',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[pagination_type]',
	array(
	'label'    => __( 'Pagination Type', 'university-hub' ),
	'section'  => 'section_pagination',
	'type'     => 'select',
	'choices'  => university_hub_get_pagination_type_options(),
	'priority' => 100,
	)
);

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
	'title'      => __( 'Footer Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_textarea_content',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => __( 'Copyright Text', 'university-hub' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting show_social_in_footer.
$wp_customize->add_setting( 'theme_options[show_social_in_footer]',
	array(
		'default'           => $default['show_social_in_footer'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'university_hub_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_social_in_footer]',
	array(
		'label'    => __( 'Show Social Icons', 'university-hub' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Blog Section.
$wp_customize->add_section( 'section_blog',
	array(
	'title'      => __( 'Blog Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting excerpt_length.
$wp_customize->add_setting( 'theme_options[excerpt_length]',
	array(
	'default'           => $default['excerpt_length'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[excerpt_length]',
	array(
	'label'       => __( 'Excerpt Length', 'university-hub' ),
	'description' => __( 'in words', 'university-hub' ),
	'section'     => 'section_blog',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);

// Setting read_more_text.
$wp_customize->add_setting( 'theme_options[read_more_text]',
	array(
	'default'           => $default['read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[read_more_text]',
	array(
	'label'    => __( 'Read More Text', 'university-hub' ),
	'section'  => 'section_blog',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting exclude_categories.
$wp_customize->add_setting( 'theme_options[exclude_categories]',
	array(
	'default'           => $default['exclude_categories'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[exclude_categories]',
	array(
	'label'       => __( 'Exclude Categories in Blog', 'university-hub' ),
	'description' => __( 'Enter category ID to exclude in Blog Page. Separate with comma if more than one', 'university-hub' ),
	'section'     => 'section_blog',
	'type'        => 'text',
	'priority'    => 100,
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'section_breadcrumb',
	array(
	'title'      => __( 'Breadcrumb Options', 'university-hub' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'theme_options[breadcrumb_type]',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'university_hub_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[breadcrumb_type]',
	array(
	'label'       => __( 'Breadcrumb Type', 'university-hub' ),
	'description' => sprintf( __( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'university-hub' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
	'section'     => 'section_breadcrumb',
	'type'        => 'select',
	'choices'     => university_hub_get_breadcrumb_type_options(),
	'priority'    => 100,
	)
);
