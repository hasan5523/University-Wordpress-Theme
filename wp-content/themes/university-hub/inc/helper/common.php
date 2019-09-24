<?php
/**
 * Common helper functions.
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_the_excerpt' ) ) :

	/**
	 * Generate excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length Excerpt length in words.
	 * @param WP_Post $post_obj WP_Post instance (Optional).
	 * @return string Excerpt.
	 */
	function university_hub_the_excerpt( $length = 0, $post_obj = null ) {

		global $post;

		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_obj->post_content;

		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
		return $trimmed_content;

	}

endif;

if ( ! function_exists( 'university_hub_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function university_hub_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once trailingslashit( get_template_directory() ) . 'lib/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);

		breadcrumb_trail( $breadcrumb_args );

	}

endif;

if ( ! function_exists( 'university_hub_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function university_hub_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'university-hub' ) ) {
			$fonts[] = 'Roboto:400,700,900,400italic,700italic,900italic';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;

	}

endif;

if( ! function_exists( 'university_hub_get_sidebar_options' ) ) :

  /**
   * Get sidebar options.
   *
   * @since 1.0.0
   */
  function university_hub_get_sidebar_options() {

  	global $wp_registered_sidebars;

  	$output = array();

  	if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
  		foreach ( $wp_registered_sidebars as $key => $sidebar ) {
  			$output[$key] = $sidebar['name'];
  		}
  	}

  	return $output;

  }

endif;

if( ! function_exists( 'university_hub_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function university_hub_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'university-hub' ) . '</a></li>';
		wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 6,
		) );
		echo '</ul>';

	}

endif;

if ( ! function_exists( 'university_hub_the_custom_logo' ) ) :

	/**
	 * Render logo.
	 *
	 * @since 2.0
	 */
	function university_hub_the_custom_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

endif;

/**
 * Sanitize post ID.
 *
 * @since 1.0.0
 *
 * @param string $key Field key.
 * @param array  $field Field detail.
 * @param mixed  $value Raw value.
 * @return mixed Sanitized value.
 */
function university_hub_widget_sanitize_post_id( $key, $field, $value ) {

	$output = '';
	$value = absint( $value );
	if ( $value ) {
		$not_allowed = array( 'revision', 'attachment', 'nav_menu_item' );
		$post_type = get_post_type( $value );
		if ( ! in_array( $post_type, $not_allowed ) && 'publish' === get_post_status( $value ) ) {
			$output = $value;
		}
	}
	return $output;

}

if ( ! function_exists( 'university_hub_get_index_page_id' ) ) :

	/**
	 * Get front index page ID.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return int Corresponding Page ID.
	 */
	function university_hub_get_index_page_id( $type = 'front' ) {

		$page = '';

		switch ( $type ) {
			case 'front':
				$page = get_option( 'page_on_front' );
				break;

			case 'blog':
				$page = get_option( 'page_for_posts' );
				break;

			default:
				break;
		}
		$page = absint( $page );
		return $page;

	}
endif;

if ( ! function_exists( 'university_hub_render_select_dropdown' ) ) :

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $main_args     Main arguments.
	 * @param string $callback      Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	function university_hub_render_select_dropdown( $main_args, $callback, $callback_args = array() ) {

		$defaults = array(
			'id'          => '',
			'name'        => '',
			'selected'    => 0,
			'echo'        => true,
			'add_default' => false,
			);

		$r = wp_parse_args( $main_args, $defaults );
		$output = '';
		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) || true === $r['add_default'] ) {

			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
			if ( true === $r['add_default'] ) {
				$output .= '<option value="">' . __( 'Default', 'university-hub' ) . '</option>\n';
			}
			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
			}
			$output .= "</select>\n";
		}

		if ( $r['echo'] ) {
			echo $output;
		}
		return $output;

	}

endif;

/**
 * Splice array preserving array keys.
 *
 * @param  array &$input      Input array.
 * @param  int   $offset      Offset.
 * @param  int   $length      Length.
 * @param  array $replacement Sub array.
 * @return array New array.
 */
function university_hub_array_splice_preserve_keys( &$input, $offset, $length = null, $replacement = array() ) {
	if ( empty( $replacement ) ) {
		return array_splice( $input, $offset, $length );
	}

	$part_before  = array_slice( $input, 0, $offset, $preserve_keys = true );
	$part_removed = array_slice( $input, $offset, $length, $preserve_keys = true );
	$part_after   = array_slice( $input, $offset + $length, null, $preserve_keys = true );

	$input = $part_before + $replacement + $part_after;

	return $part_removed;
}

if ( ! function_exists( 'university_hub_get_active_homepage_sections' ) ) :

	/**
	 * Returns active homepage sections.
	 *
	 * @since 1.0.0
	 *
	 * @return array Active sections.
	 */
	function university_hub_get_active_homepage_sections() {

		$output = array();

		$homepage_sections_raw = (array)university_hub_get_option( 'homepage_sections' );

		if ( ! empty( $homepage_sections_raw ) ) {
			$default_sections = university_hub_get_home_sections_options();
			foreach ( $homepage_sections_raw as $key ) {
				if ( isset( $default_sections[ $key ] ) ) {
					$output[ $key ] = $default_sections[ $key ];
				}
			}
		}

		return $output;

	}
endif;

if ( ! function_exists( 'university_hub_get_news_ticker_content' ) ) :

	/**
	 * Get news ticker content.
	 *
	 * @since 1.0.0
	 */
	function university_hub_get_news_ticker_content(){

		$tickers = university_hub_news_ticker_details();

		if ( empty( $tickers ) ) {
			return;
		}

		ob_start();
		?>
		<div id="news-ticker">
			<div class="news-ticker-inner-wrap">
				<?php foreach ( $tickers as $key => $ticker ) : ?>
					<div class="list">
						<a href="<?php echo esc_url( $ticker['link'] ); ?>"><?php echo esc_html( $ticker['text'] ); ?></a>
					</div>
				<?php endforeach ?>
			</div> <!-- .news-ticker-inner-wrap -->
		</div><!-- #news-ticker -->
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
endif;

if ( ! function_exists( 'university_hub_news_ticker_details' ) ) :

	/**
	 * Get news ticker details.
	 *
	 * @since 1.0.0
	 */
	function university_hub_news_ticker_details(){

		$output = array();

		$ticker_category = university_hub_get_option( 'ticker_category' );
		$ticker_number   = university_hub_get_option( 'ticker_number' );

		$qargs = array(
			'posts_per_page' => absint( $ticker_number ),
			'no_found_rows'  => true,
			'post_type'      => 'post',
		);
		if ( absint( $ticker_category ) > 0 ) {
		  $qargs['cat'] = absint( $ticker_category );
		}

		$all_posts = get_posts( $qargs );

		if ( $all_posts ) {
			$i = 0;
			foreach ( $all_posts as $post ) {
				$output[$i]['text'] = get_the_title( $post->ID );
				$output[$i]['link'] = get_permalink( $post->ID );
				$i++;
			}
		}

		return $output;

	}
endif;
