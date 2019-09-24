<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function university_hub_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'university-hub' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'university-hub-thumb', 400, 300 );

		// Register nav menu locations.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'university-hub' ),
			'top'      => esc_html__( 'Top Menu', 'university-hub' ),
			'footer'   => esc_html__( 'Footer Menu', 'university-hub' ),
			'social'   => esc_html__( 'Social Menu', 'university-hub' ),
			'notfound' => esc_html__( '404 Menu', 'university-hub' ),
		) );

		/*
		 * Switch default core markup to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'university_hub_custom_background_args', array(
			'default-color' => 'f7fcfe',
		) ) );

		// Enable support for selective refresh of widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Supports.
		require_once get_template_directory() . '/inc/support.php';

	}
endif;

add_action( 'after_setup_theme', 'university_hub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function university_hub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'university_hub_content_width', 640 );
}
add_action( 'after_setup_theme', 'university_hub_content_width', 0 );

/**
 * Register widget area.
 */
function university_hub_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'university-hub' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'university-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'university-hub' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'university-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'university_hub_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function university_hub_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'university-hub-font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	$fonts_url = university_hub_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'university-hub-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'jquery-sidr', get_template_directory_uri() .'/third-party/sidr/css/jquery.sidr.dark' . $min . '.css', '', '2.2.1' );

	wp_enqueue_style( 'university-hub-style', get_stylesheet_uri(), array(), '1.0.9' );

	wp_enqueue_script( 'university-hub-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/third-party/sidr/js/jquery.sidr' . $min . '.js', array( 'jquery' ), '2.2.1', true );

	wp_enqueue_script( 'jquery-easy-ticker', get_template_directory_uri() . '/third-party/ticker/jquery.easy-ticker' . $min . '.js', array( 'jquery' ), '2.0', true );

	wp_enqueue_script( 'university-hub-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '1.0.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'university_hub_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function university_hub_admin_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_style( 'university-hub-metabox', get_template_directory_uri() . '/css/metabox' . $min . '.css', '', '1.0.1' );
		wp_enqueue_script( 'university-hub-metabox', get_template_directory_uri() . '/js/metabox' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ), '1.0.1', true );
	}

	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	    wp_enqueue_media();
		wp_enqueue_style( 'university-hub-widgets', get_template_directory_uri() . '/css/widgets' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'university-hub-widgets', get_template_directory_uri() . '/js/widgets' . $min . '.js', array( 'jquery' ), '1.0.1', true );
	}

}
add_action( 'admin_enqueue_scripts', 'university_hub_admin_scripts' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';
