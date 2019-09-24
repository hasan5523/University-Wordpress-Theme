<?php
/**
 * Default theme options.
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function university_hub_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['show_ticker']           = true;
		$defaults['ticker_title']          = esc_html__( 'News:', 'university-hub' );
		$defaults['ticker_category']       = 0;
		$defaults['ticker_number']         = 3;
		$defaults['contact_number']        = '';
		$defaults['contact_email']         = '';
		$defaults['contact_address_1']     = '';
		$defaults['contact_address_2']     = '';
		$defaults['show_social_in_header'] = false;
		$defaults['search_in_header']      = true;

		// Layout.
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';
		$defaults['single_image']            = 'large';

		// Home Page.
		$defaults['home_content_status'] = true;

		// Pagination.
		$defaults['pagination_type'] = 'default';

		// Footer.
		$defaults['copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'university-hub' );
		$defaults['show_social_in_footer'] = false;

		// Blog.
		$defaults['excerpt_length']     = 40;
		$defaults['read_more_text']     = esc_html__( 'Read more', 'university-hub' );
		$defaults['exclude_categories'] = '';

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'simple';

		// Homepage Sections.
		$defaults['homepage_sections'] = array( 'news-and-events', 'latest-news' );

		// Homepage News and Events.
		$defaults['news_and_events_ntitle']    = esc_html__( 'News', 'university-hub' );
		$defaults['news_and_events_nnumber']   = 2;
		$defaults['news_and_events_ncategory'] = 0;
		$defaults['news_and_events_etitle']    = esc_html__( 'Events', 'university-hub' );
		$defaults['news_and_events_enumber']   = 4;
		$defaults['news_and_events_ecategory'] = 0;

		// Homepage Call To Action.
		$defaults['cta_title']               = esc_html__( 'Join Our University', 'university-hub' );
		$defaults['cta_description']         = esc_html__( 'Every undergraduate student is eligible to receive a fellowship of up to $10,000 for a summer internship or faculty-mentored research project. Find your opportunity, make your case for how it fits your academic plans, and we will help fund it.', 'university-hub' );
		$defaults['cta_primary_button_text'] = esc_html__( 'Learn More', 'university-hub' );
		$defaults['cta_primary_button_url']  = '#';
		$defaults['cta_secondary_button_text'] = esc_html__( 'Online Tour', 'university-hub' );
		$defaults['cta_secondary_button_url']  = '#';

		// Homepage Latest News.
		$defaults['latest_news_title']          = esc_html__( 'Latest News', 'university-hub' );
		$defaults['latest_news_layout']         = 1;
		$defaults['latest_news_category']       = 0;
		$defaults['latest_news_number']         = 4;
		$defaults['latest_news_column']         = 4;
		$defaults['latest_news_featured_image'] = 'university-hub-thumb';
		$defaults['latest_news_excerpt_length'] = 20;

		// Slider Options.
		$defaults['featured_slider_status']              = 'disabled';
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_type']                = 'featured-page';
		$defaults['featured_slider_number']              = 3;
		$defaults['featured_slider_category']            = '';
		$defaults['featured_slider_tag']                 = '';
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'university-hub' );

		// Pass through filter.
		$defaults = apply_filters( 'university_hub_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
