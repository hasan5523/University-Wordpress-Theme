<?php
/**
 * Helper functions related to customizer and options.
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_global_layout_options() {

		$choices = array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'university-hub' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'university-hub' ),
			'three-columns' => esc_html__( 'Three Columns', 'university-hub' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'university-hub' ),
		);
		$output = apply_filters( 'university_hub_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'university_hub_get_pagination_type_options' ) ) :

	/**
	 * Returns pagination type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_pagination_type_options() {

		$choices = array(
			'default' => esc_html__( 'Default (Older / Newer Post)', 'university-hub' ),
			'numeric' => esc_html__( 'Numeric', 'university-hub' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'university_hub_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_breadcrumb_type_options() {

		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'university-hub' ),
			'simple'   => esc_html__( 'Simple', 'university-hub' ),
			'advanced' => esc_html__( 'Advanced', 'university-hub' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'university_hub_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'university-hub' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'university-hub' ),
		);
		$output = apply_filters( 'university_hub_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'university_hub_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @return array Image size options.
	 */
	function university_hub_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'university-hub' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'university-hub' );
		$choices['medium']    = esc_html__( 'Medium', 'university-hub' );
		$choices['large']     = esc_html__( 'Large', 'university-hub' );
		$choices['full']      = esc_html__( 'Full (original)', 'university-hub' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ){
					$choices[ $key ] .= ' ('. $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;


if ( ! function_exists( 'university_hub_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'alignment', 'university-hub' ),
			'left'   => _x( 'Left', 'alignment', 'university-hub' ),
			'center' => _x( 'Center', 'alignment', 'university-hub' ),
			'right'  => _x( 'Right', 'alignment', 'university-hub' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'university_hub_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'transition effect', 'university-hub' ),
			'fadeout'    => _x( 'fadeout', 'transition effect', 'university-hub' ),
			'none'       => _x( 'none', 'transition effect', 'university-hub' ),
			'scrollHorz' => _x( 'scrollHorz', 'transition effect', 'university-hub' ),
		);
		$output = apply_filters( 'university_hub_filter_featured_slider_transition_effects', $choices );

		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'university_hub_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_featured_slider_content_options() {

		$choices = array(
			'home-page' => esc_html__( 'Static Front Page Only', 'university-hub' ),
			'disabled'  => esc_html__( 'Disabled', 'university-hub' ),
		);
		$output = apply_filters( 'university_hub_filter_featured_slider_content_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'university_hub_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_featured_slider_type() {

		$choices = array(
			'featured-page' => __( 'Featured Pages', 'university-hub' ),
		);

		$output = apply_filters( 'university_hub_filter_featured_slider_type', $choices );

		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'university_hub_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int $min Min.
	 * @param int $max Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 *
	 * @return array Options array.
	 */
	function university_hub_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;

	}

endif;

if ( ! function_exists( 'university_hub_get_home_sections_options' ) ) :

	/**
	 * Returns home sections options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function university_hub_get_home_sections_options() {

		$choices = array(
			'news-and-events' => array(
				'label'    => __( 'News and Events', 'university-hub' ),
				'template' => 'template-parts/home/news-and-events',
				),
			'call-to-action' => array(
				'label'    => __( 'Call To Action', 'university-hub' ),
				'template' => 'template-parts/home/call-to-action',
				),
			'latest-news' => array(
				'label'    => __( 'Latest News', 'university-hub' ),
				'template' => 'template-parts/home/latest-news',
				),
			);
		$output = apply_filters( 'university_hub_filter_home_sections_options', $choices );
		return $output;

	}

endif;

