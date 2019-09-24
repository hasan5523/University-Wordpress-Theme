<?php
/**
 * Callback functions for active_callback.
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_is_news_ticker_active' ) ) :

	/**
	 * Check if news ticker is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function university_hub_is_news_ticker_active( $control ) {

		if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'university_hub_is_featured_slider_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function university_hub_is_featured_slider_active( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'university_hub_is_featured_page_slider_active' ) ) :

	/**
	 * Check if featured page slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function university_hub_is_featured_page_slider_active( $control ) {

		if (
		'featured-page' === $control->manager->get_setting( 'theme_options[featured_slider_type]' )->value()
		&& 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value()
		) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'university_hub_is_image_in_archive_active' ) ) :

	/**
	 * Check if image in archive is active.
	 *
	 * @since 1.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function university_hub_is_image_in_archive_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'theme_options[archive_image]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'university_hub_is_image_in_single_active' ) ) :

	/**
	 * Check if image in single is active.
	 *
	 * @since 1.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function university_hub_is_image_in_single_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'theme_options[single_image]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
