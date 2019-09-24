<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_skip_to_content' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function university_hub_skip_to_content() {
	?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'university-hub' ); ?></a><?php
	}
endif;

add_action( 'university_hub_action_before', 'university_hub_skip_to_content', 15 );


if ( ! function_exists( 'university_hub_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function university_hub_site_branding() {

		?>
	    <div class="site-branding">

			<?php university_hub_the_custom_logo(); ?>

			<?php $show_title = university_hub_get_option( 'show_title' ); ?>
			<?php $show_tagline = university_hub_get_option( 'show_tagline' ); ?>
			<?php if ( true === $show_title || true === $show_tagline ) :  ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) :  ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) :  ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
	    </div><!-- .site-branding -->
	    <?php
			$contact_number    = university_hub_get_option( 'contact_number' );
			$contact_email     = university_hub_get_option( 'contact_email' );
			$contact_address_1 = university_hub_get_option( 'contact_address_1' );
			$contact_address_2 = university_hub_get_option( 'contact_address_2' );
		?>
		<div id="quick-contact">
			<?php if ( ! empty( $contact_number ) || ! empty( $contact_email ) || ! empty( $contact_address_1 )  || ! empty( $contact_address_2 )) : ?>
				<ul>
					<?php if ( ! empty( $contact_number ) || ! empty( $contact_email ) ) : ?>
						<li class="quick-call-info">
							<a class="quick-call" href="tel:<?php echo preg_replace( '/\D+/', '', esc_attr( $contact_number ) ); ?>"><?php echo esc_attr( $contact_number ); ?></a>
							<a  class="quick-email" href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_attr( antispambot( $contact_email ) ); ?></a>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $contact_address_1 ) || ! empty( $contact_address_2 ) ) : ?>
						<li class="quick-address-info">
						<span class="main-address"><?php echo esc_html( $contact_address_1 ); ?></span>
						<span class="sub-address"><?php echo esc_html( $contact_address_2 ); ?></span>
						</li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div><!-- #quick-contact -->

	    <div id="main-nav">
	        <nav id="site-navigation" class="main-navigation" role="navigation">
	            <div class="wrap-menu-content">
					<?php
					wp_nav_menu(
						array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'fallback_cb'    => 'university_hub_primary_navigation_fallback',
						)
					);
					?>
	            </div><!-- .menu-content -->
	        </nav><!-- #site-navigation -->
	        <?php $search_in_header = university_hub_get_option( 'search_in_header' ); ?>
	        <?php if ( true === $search_in_header ) : ?>
		        <div class="header-search-box">
		        	<?php get_search_form(); ?>
		        </div>
        	<?php endif; ?>
	    </div> <!-- #main-nav -->
	    <?php
	}

endif;

add_action( 'university_hub_action_header', 'university_hub_site_branding' );

if ( ! function_exists( 'university_hub_header_top_content' ) ) :

	/**
	 * Header Top.
	 *
	 * @since 1.0.0
	 */
	function university_hub_header_top_content() {
		$show_ticker = university_hub_get_option( 'show_ticker' );
		?>
		<div id="tophead">
			<div class="container">
				<?php if ( true === $show_ticker ) : ?>
					<div class="top-news">
						<span class="top-news-title">
						<?php $ticker_title = university_hub_get_option( 'ticker_title' );  ?>
						<?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
						</span>
						<?php echo university_hub_get_news_ticker_content(); ?>
					</div> <!-- #top-news -->
				<?php endif; ?>

				<?php if ( true === university_hub_get_option( 'show_social_in_header' )  ) : ?>
					<div id="header-social">
						<?php the_widget( 'University_Hub_Social_Widget' ); ?>
					</div><!-- #header-social -->
				<?php endif; ?>

				<?php if ( has_nav_menu( 'top' ) ) : ?>
					<div id="top-nav">
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'top',
								'container'       => 'nav',
								'container_class' => 'top-navigation',
								'depth'           => 2,
								'fallback_cb'     => false,
							) );
						 ?>
					</div> <!-- #top-nav -->
				<?php endif; ?>
			</div> <!-- .container -->
		</div><!--  #tophead -->
		<?php
	}

endif;

add_action( 'university_hub_action_before_header', 'university_hub_header_top_content', 5 );

if ( ! function_exists( 'university_hub_mobile_navigation' ) ) :

	/**
	 * Mobile navigation.
	 *
	 * @since 2.0.0
	 */
	function university_hub_mobile_navigation() {
		?>
		<div class="mobile-nav-wrap">
		<a id="mobile-trigger" href="#mob-menu"><i class="fa fa-bars"></i></a>
		<div id="mob-menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => '',
				'fallback_cb'    => 'university_hub_primary_navigation_fallback',
				) );
			?>
		</div><!-- #mob-menu -->
		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<a id="mobile-trigger2" href="#mob-menu2"><i class="fa fa-bars"></i></a>
			<div id="mob-menu2">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'top',
					'container'      => '',
					) );
				?>
			</div><!-- #mob-menu2 -->

		<?php endif; ?>
		</div> <!-- .mobile-nav-wrap -->
		<?php

	}

endif;
add_action( 'university_hub_action_before', 'university_hub_mobile_navigation', 20 );

if ( ! function_exists( 'university_hub_footer_copyright' ) ) :

	/**
	 * Footer copyright
	 *
	 * @since 1.0.0
	 */
	function university_hub_footer_copyright() {

		// Check if footer is disabled.
		$footer_status = apply_filters( 'university_hub_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Footer Menu.
		$footer_menu_content = wp_nav_menu( array(
			'theme_location' => 'footer',
			'container'      => 'div',
			'container_id'   => 'footer-navigation',
			'depth'          => 1,
			'fallback_cb'    => false,
			'echo'           => false,
		) );

		// Copyright content.
		$copyright_text = university_hub_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'university_hub_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( __( 'University Hub by %s', 'university-hub' ), '<a target="_blank" rel="designer" href="https://wenthemes.com/">' . __( 'WEN Themes', 'university-hub' ) . '</a>' );

		// Social in footer.
		$show_social_in_footer = university_hub_get_option( 'show_social_in_footer' );
		?>

		<div class="colophon-inner">

		    <?php if ( true === $show_social_in_footer && has_nav_menu( 'social' ) ) : ?>
			    <div class="colophon-column">
			    	<div class="footer-social">
			    		<?php the_widget( 'University_Hub_Social_Widget' ); ?>
			    	</div><!-- .footer-social -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if ( ! empty( $copyright_text ) ) : ?>
			    <div class="colophon-column">
			    	<div class="copyright">
			    		<?php echo $copyright_text; ?>
			    	</div><!-- .copyright -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if ( ! empty( $footer_menu_content ) ) : ?>
		    	<div class="colophon-column">
					<?php echo $footer_menu_content; ?>
		    	</div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if ( ! empty( $powered_by_text ) ) : ?>
			    <div class="colophon-column">
			    	<div class="site-info">
			    		<?php echo $powered_by_text; ?>
			    	</div><!-- .site-info -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		</div><!-- .colophon-inner -->

	    <?php
	}

endif;

add_action( 'university_hub_action_footer', 'university_hub_footer_copyright', 10 );


if ( ! function_exists( 'university_hub_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function university_hub_add_sidebar() {

		global $post;

		$global_layout = university_hub_get_option( 'global_layout' );
		$global_layout = apply_filters( 'university_hub_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'university_hub_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}
		// Include Secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
			get_sidebar( 'secondary' );
			break;

			default:
			break;
		}

	}

endif;

add_action( 'university_hub_action_sidebar', 'university_hub_add_sidebar' );


if ( ! function_exists( 'university_hub_custom_posts_navigation' ) ) :
	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function university_hub_custom_posts_navigation() {

		$pagination_type = university_hub_get_option( 'pagination_type' );

		switch ( $pagination_type ) {

			case 'default':
				the_posts_navigation();
			break;

			case 'numeric':
				the_posts_pagination();
			break;

			default:
			break;
		}

	}
endif;

add_action( 'university_hub_action_posts_navigation', 'university_hub_custom_posts_navigation' );


if ( ! function_exists( 'university_hub_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 1.0.0
	 */
	function university_hub_add_image_in_single_display() {

		global $post;

		if ( has_post_thumbnail() ) {

			$values = get_post_meta( $post->ID, 'university_hub_theme_settings', true );
			$university_hub_theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';

			if ( ! $university_hub_theme_settings_single_image ) {
				$university_hub_theme_settings_single_image = university_hub_get_option( 'single_image' );
			}

			if ( 'disable' !== $university_hub_theme_settings_single_image ) {
				$args = array(
					'class' => 'aligncenter',
				);
				the_post_thumbnail( esc_attr( $university_hub_theme_settings_single_image ), $args );
			}
		}

	}

endif;

add_action( 'university_hub_single_image', 'university_hub_add_image_in_single_display' );

if ( ! function_exists( 'university_hub_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function university_hub_add_breadcrumb() {

		// Bail if Breadcrumb disabled.
		$breadcrumb_type = university_hub_get_option( 'breadcrumb_type' );
		if ( 'disabled' === $breadcrumb_type ) {
			return;
		}

		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="container">';
		switch ( $breadcrumb_type ) {
			case 'simple':
				university_hub_simple_breadcrumb();
			break;

			case 'advanced':
				if ( function_exists( 'bcn_display' ) ) {
					bcn_display();
				}
			break;

			default:
			break;
		}
		echo '</div><!-- .container --></div><!-- #breadcrumb -->';

	}

endif;

add_action( 'university_hub_action_before_content', 'university_hub_add_breadcrumb', 7 );

if ( ! function_exists( 'university_hub_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function university_hub_footer_goto_top() {

		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-angle-up"></i></a>';

	}

endif;

add_action( 'university_hub_action_after', 'university_hub_footer_goto_top', 20 );

if ( ! function_exists( 'university_hub_add_front_page_home_sections' ) ) :

	/**
	 * Add Front Page widget sections.
	 *
	 * @since 1.0.0
	 */
	function university_hub_add_front_page_home_sections() {

		$section_status = apply_filters( 'university_hub_filter_front_page_home_sections_status', false );

		if ( true !== $section_status ) {
			return;
		}

		$active_sections = university_hub_get_active_homepage_sections();

		if ( ! empty( $active_sections ) ) {
			echo '<div id="front-page-home-sections" class="widget-area">';
			foreach ( $active_sections as $section ) {
				get_template_part( $section['template'] );
			}
			echo '</div><!-- #front-page-home-sections -->';
		}

	}
endif;

add_action( 'university_hub_action_before_content', 'university_hub_add_front_page_home_sections', 6 );



if( ! function_exists( 'university_hub_check_front_homepage_section_status' ) ) :

	/**
	 * Check status of front homepage section.
	 *
	 * @since 1.0.0
	 */
	function university_hub_check_front_homepage_section_status( $input ) {

		$current_id = university_hub_get_index_page_id();

		if ( is_front_page() && get_queried_object_id() === $current_id && $current_id > 0 ) {
			$input = true;
		}

		return $input;

	}
endif;

add_filter( 'university_hub_filter_front_page_home_sections_status', 'university_hub_check_front_homepage_section_status' );

if ( ! function_exists( 'university_hub_check_home_page_content' ) ) :

	/**
	 * Check home page content status.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function university_hub_check_home_page_content( $status ) {

		if ( is_front_page() ) {
			$home_content_status = university_hub_get_option( 'home_content_status' );
			if ( false === $home_content_status ) {
				$status = false;
			}
		}
		return $status;

	}

endif;

add_action( 'university_hub_filter_home_page_content', 'university_hub_check_home_page_content' );
