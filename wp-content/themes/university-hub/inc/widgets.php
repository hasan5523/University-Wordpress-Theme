<?php
/**
 * Theme widgets.
 *
 * @package University_Hub
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'university_hub_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function university_hub_load_widgets() {

		// Social widget.
		register_widget( 'University_Hub_Social_Widget' );

		// Featured Page widget.
		register_widget( 'University_Hub_Featured_Page_Widget' );

		// Recent Posts widget.
		register_widget( 'University_Hub_Recent_Posts_Widget' );

	}

endif;

add_action( 'widgets_init', 'university_hub_load_widgets' );

if ( ! class_exists( 'University_Hub_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class University_Hub_Social_Widget extends University_Hub_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'university_hub_widget_social',
				'description'                 => __( 'Displays social icons.', 'university-hub' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'university-hub' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'university-hub' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'university-hub-social', __( 'UH: Social', 'university-hub' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'University_Hub_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 1.0.0
	 */
	class University_Hub_Featured_Page_Widget extends University_Hub_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'university_hub_widget_featured_page',
				'description'                 => __( 'Displays single featured Page or Post.', 'university-hub' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'university-hub' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'use_page_title' => array(
					'label'   => __( 'Use Page/Post Title as Widget Title', 'university-hub' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'featured_page' => array(
					'label'            => __( 'Select Page:', 'university-hub' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'university-hub' ),
					),
				'id_message' => array(
					'label' => '<strong>' . _x( 'OR', 'message', 'university-hub' ) . '</strong>',
					'type'  => 'message',
					),
				'featured_post' => array(
					'label'             => __( 'Post ID:', 'university-hub' ),
					'placeholder'       => __( 'Eg: 1234', 'university-hub' ),
					'type'              => 'text',
					'sanitize_callback' => 'university_hub_widget_sanitize_post_id',
					),
				'content_type' => array(
					'label'   => __( 'Show Content:', 'university-hub' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => __( 'Excerpt', 'university-hub' ),
						'full'    => __( 'Full', 'university-hub' ),
						),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'university-hub' ),
					'description' => __( 'Applies when Excerpt is selected in Content option.', 'university-hub' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 40,
					'min'         => 1,
					'max'         => 400,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'university-hub' ),
					'type'    => 'select',
					'options' => university_hub_get_image_sizes_options(),
					),
				'featured_image_alignment' => array(
					'label'   => __( 'Image Alignment:', 'university-hub' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => university_hub_get_image_alignment_options(),
					),
				);

			parent::__construct( 'university-hub-featured-page', __( 'UH: Featured Page', 'university-hub' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// ID validation.
			$our_post_object = null;
			$our_id = '';
			if ( absint( $params['featured_post'] ) > 0 ) {
				$our_id = absint( $params['featured_post'] );
			}
			if ( absint( $params['featured_page'] ) > 0 ) {
				$our_id = absint( $params['featured_page'] );
			}
			if ( absint( $our_id ) > 0 ) {
				$raw_object = get_post( $our_id );
				if ( ! in_array( $raw_object->post_type, array( 'attachment', 'nav_menu_item', 'revision' ) ) ) {
					$our_post_object = $raw_object;
				}
			}
			if ( ! $our_post_object ) {
				// No valid object; bail now!
				return;
			}

			echo $args['before_widget'];

			global $post;
			// Setup global post.
			$post = $our_post_object;
			setup_postdata( $post );

			// Override title if checkbox is selected.
			if ( true === $params['use_page_title'] ) {
				$params['title'] = get_the_title( $post );
			}

			?>
			<div class="featured-page-widget entry-content">
				<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( esc_attr( $params['featured_image'] ), array( 'class' => 'align' . esc_attr( $params['featured_image_alignment'] ) ) ); ?>
				<?php endif; ?>
				<div class="fetured-page-content">
				<?php
					if ( ! empty( $params['title'] ) ) {
						echo $args['before_title'] . $params['title'] . $args['after_title'];
					}
				?>
				<?php if ( 'excerpt' === $params['content_type'] ) : ?>
					<?php
						$excerpt = university_hub_the_excerpt( absint( $params['excerpt_length'] ) );
						echo wp_kses_post( wpautop( $excerpt ) );
						?>
				<?php else : ?>
					<?php the_content(); ?>
				<?php endif; ?>
				</div> <!-- .fetured-page-content -->
			</div><!-- .featured-page-widget -->
			<?php
			// Reset.
			wp_reset_postdata();

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'University_Hub_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 1.0.0
	 */
	class University_Hub_Recent_Posts_Widget extends University_Hub_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'university_hub_widget_recent_posts',
				'description'                 => __( 'Displays recent posts.', 'university-hub' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'university-hub' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'university-hub' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'university-hub' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'university-hub' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'university-hub' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => university_hub_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
					),
				'image_width' => array(
					'label'       => __( 'Image Width:', 'university-hub' ),
					'type'        => 'number',
					'description' => __( 'px', 'university-hub' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 60,
					'min'         => 1,
					'max'         => 150,
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'university-hub' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'university-hub-recent-posts', __( 'UH: Recent Posts', 'university-hub' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = $params['post_category'];
			}
			$all_posts = get_posts( $qargs );

			?>
			<?php if ( ! empty( $all_posts ) ) :  ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php foreach ( $all_posts as $key => $post ) :  ?>
						<?php setup_postdata( $post ); ?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) :  ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ). 'px;',
											);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) :  ?>
									<div class="recent-posts-meta">

										<?php if ( false === $params['disable_date'] ) :  ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endforeach; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); // Reset. ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;
