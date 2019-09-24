<?php
/**
 * Core functions.
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function university_hub_get_option( $key ) {

		$default_options = university_hub_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;

if ( ! function_exists( 'university_hub_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Theme options.
	 */
  function university_hub_get_options() {

    $default_options = university_hub_get_default_theme_options();
    $theme_options = (array)get_theme_mod( 'theme_options' );
    $theme_options = wp_parse_args( $theme_options, $default_options );
    return $theme_options;

  }

endif;

if( ! function_exists( 'university_hub_exclude_category_in_blog_page' ) ) :

  /**
   * Exclude category in blog page.
   *
   * @since 1.0
   */
  function university_hub_exclude_category_in_blog_page( $query ) {

    if( $query->is_home && $query->is_main_query()   ) {
      $exclude_categories = university_hub_get_option( 'exclude_categories' );
      if ( ! empty( $exclude_categories ) ) {
        $cats = explode( ',', $exclude_categories );
        $cats = array_filter( $cats, 'is_numeric' );
        $string_exclude = '';
        if ( ! empty( $cats ) ) {
          $string_exclude = '-' . implode( ',-', $cats);
          $query->set( 'cat', $string_exclude );
        }
      }
    }
    return $query;
  }

endif;

add_filter( 'pre_get_posts', 'university_hub_exclude_category_in_blog_page' );
