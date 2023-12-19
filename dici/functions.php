<?php
/**
 * dici functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dici
 */

if ( !defined( 'THEMESZONE_THEME_VERSION' ) ) define('THEMESZONE_THEME_VERSION', '1.0.0');

if ( ! function_exists( 'dici_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dici_setup() {

        remove_theme_support( 'widgets-block-editor' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dici, use a find and replace
		 * to change 'dici' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dici', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


		register_nav_menus( array(
			'menu-main' => esc_html__( 'Primary', 'dici' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'dici_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/**
		 * Add support for all post formats.
		 *
		 * @link https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) );

		/**
		 * Add support for Yoast SEO plugin breadcrumbs
		 *
		 * @link https://kb.yoast.com/kb/add-theme-support-for-yoast-seo-breadcrumbs/
		 */
		add_theme_support( 'yoast-seo-breadcrumbs' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'disable-custom-colors' );
        add_editor_style( 'style-editor.css' );

        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'DiCi Accent Color', 'dici' ),
                'slug'  => 'dici-accent-color',
                'color'	=> '#00d1b7',
            ),
            array(
                'name'  => esc_html__( 'Dici Accent Text Color', 'dici' ),
                'slug'  => 'dici-accent-text-color',
                'color' => '#109d92',
            ),
            array(
                'name'  => esc_html__( 'DiCi Text Color', 'dici' ),
                'slug'  => 'dici-main-text-color',
                'color' => '#262626',
            ),
            array(
                'name'  => esc_html__( 'DiCi Secondary Deco Color', 'dici' ),
                'slug'  => 'dici-second-deco-color',
                'color' => '#939393',
            ),
            array(
                'name'  => esc_html__( 'DiCi Hover Color', 'dici' ),
                'slug'  => 'dici-hover-color',
                'color' => '#363636',
            ),
        ) );

        add_theme_support( 'editor-font-sizes', array(
            array(
                'name'      => esc_html__( 'Extra Small', 'dici' ),
                'shortName' => esc_html__( 'XS', 'dici' ),
                'size'      => 11,
                'slug'      => 'xsmall'
            ),
            array(
                'name'      => esc_html__( 'Small', 'dici' ),
                'shortName' => esc_html__( 'S', 'dici' ),
                'size'      => 14,
                'slug'      => 'small'
            ),
            array(
                'name'      => esc_html__( 'Normal', 'dici' ),
                'shortName' => esc_html__( 'M', 'dici' ),
                'size'      => 15,
                'slug'      => 'normal'
            ),
            array(
                'name'      => esc_html__( 'Large', 'dici' ),
                'shortName' => esc_html__( 'L', 'dici' ),
                'size'      => 20,
                'slug'      => 'large'
            ),
            array(
                'name'      => esc_html__( 'Larger', 'dici' ),
                'shortName' => esc_html__( 'XL', 'dici' ),
                'size'      => 32,
                'slug'      => 'larger'
            ),
            array(
                'name'      => esc_html__( 'Largest', 'dici' ),
                'shortName' => esc_html__( 'XXL', 'dici' ),
                'size'      => 40,
                'slug'      => 'largest'
            )
        ) );


	}
endif;
add_action( 'after_setup_theme', 'dici_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dici_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dici_content_width', 1380 );
}
add_action( 'after_setup_theme', 'dici_content_width', 0 );

add_filter( 'widget_text', 'do_shortcode' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dici_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'dici' ),
		'id'            => 'sidebar-blog', // Do not modify ids
		'description'   => esc_html__( 'Add widgets here.', 'dici' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'dici' ),
		'id'            => 'sidebar-page', // Do not modify ids
		'description'   => esc_html__( 'Add widgets here.', 'dici' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'dici_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dici_scripts() {

	wp_enqueue_style( 'dici', get_stylesheet_uri() );

	wp_enqueue_script( 'dici-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'dici-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_style( 'dici-icons',  get_template_directory_uri().'/assets/css/dici-icons.css');

	wp_enqueue_script( 'dici', get_template_directory_uri() . '/js/main.js', array(), THEMESZONE_THEME_VERSION, true );

	wp_localize_script( 'dici', 'theme_vars', array('theme_prefix' => 'dici', 'js_path' => get_template_directory_uri() . '/js/') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'dici_scripts' );

function dici_get_js_theme_vars(){

}


/**
 * Load Theme Helper
 */
require_once get_template_directory() . '/inc/lib/class-tz-theme-helper.php';

/**
 * Load Theme Controller
 */
require_once get_template_directory() . '/inc/lib/class-tz-theme-controller.php';
require_once get_template_directory() . '/inc/class-dici-controller.php';
// Run controller
add_action( 'after_setup_theme', 'DiCi_Controller::instance' );

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom header tags for this theme.
 */
require_once get_template_directory() . '/inc/header-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require_once get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require_once get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load required plugins prompt.
 */
require_once get_template_directory() . '/inc/required-plugins.php';

/**
 * Load demo data prompt.
 */
if ( class_exists( 'OCDI_Plugin' ) ) {
    require_once get_template_directory() . '/inc/demo-import.php';

}

