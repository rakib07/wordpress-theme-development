<?php
/**
 * rakibcv functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rakibcv
 */

if ( ! function_exists( 'rakib_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rakib_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rakibcv, use a find and replace
		 * to change 'rakibcv' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rakibcv', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'rakibcv' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Image Sizes
		add_image_size( 'rakibcv_92x92', 92, 92, true );
		add_image_size( 'rakibcv_140x140', 140, 140, true );
		add_image_size( 'rakibcv_600x450', 600, 450, true );
		add_image_size( 'rakibcv_600xauto', 600, 9999, false );
		add_image_size( 'rakibcv_590x330', 590, 330, true );
		add_image_size( 'rakibcv_720x478', 720, 478, true );
	}
endif;
add_action( 'after_setup_theme', 'rakib_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rakibcv_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rakibcv_content_width', 900 );
}
add_action( 'after_setup_theme', 'rakibcv_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rakibcv_widgets_init() {
	register_sidebar( array(
		'name'		  => esc_html__( 'Sidebar', 'rakibcv' ),
		'id'			=> 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rakibcv' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rakibcv_widgets_init' );

/**
 * Register Default Fonts
 */
function rakibcv_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$poppins = _x( 'on', 'Poppins: on or off', 'rakibcv' );

	
	if ( 'off' !== $poppins ) {
		$font_families = array();

		$font_families[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */

function rakibcv_stylesheets() {
	// Web fonts 
	wp_enqueue_style( 'rakibcv-fonts', rakibcv_fonts_url(), array(), null );
	
	$headingsFont =  get_field( 'heading_font_family', 'options' );
	$paragraphsFont =  get_field( 'text_font_family', 'options' );
	
	// Custom fonts
	if ( $headingsFont ) {
		wp_enqueue_style( 'rakibcv_heading_font', $headingsFont['url'] , array(), null );
	}
	if ( $paragraphsFont ) {
		wp_enqueue_style( 'rakibcv_paragraph_font', $paragraphsFont['url'] , array(), null );
	}

	/*Styles*/
	wp_enqueue_style( 'rakibcv-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.css', '1.0' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', '1.0' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', '1.0' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', '1.0' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', '1.0' );
	wp_enqueue_style( 'calendar', get_template_directory_uri() . '/assets/css/calendar.css', '1.0' );

	/*Custom CSS*/
	$custom_css = get_field( 'custom_css', 'options' );
	if ( $custom_css ) {
		wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/custom.css');

		wp_add_inline_style( 'custom-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'rakibcv_stylesheets' );

function rakibcv_scripts() {
	/*Default Scripts*/	
	wp_enqueue_script( 'rakibcv-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'rakibcv-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/*Theme Scripts*/
  
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js', array(), '1.0.0', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array(), '1.0.0', true );
	wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/assets/js/jquery.validate.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.js', array(), '1.0.0', true );
	wp_enqueue_script( 'rakibcv-isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'rakibcv-typed', get_template_directory_uri() . '/assets/js/typed.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'rrssb', get_template_directory_uri() . '/assets/js/rrssb.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'calendario', get_template_directory_uri() . '/assets/js/jquery.calendario.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'rakibcv-scripts', get_template_directory_uri() . '/assets/js/ryan-scripts.js', array('jquery'), '1.0.0', true );
	
	$google_map_api_key = get_field( 'gmap_api_key', 'options' );
	$disable_api = get_field( 'disable_api', 'options' );

	if ( !$disable_api ) {
		wp_enqueue_script( 'rakibcv-google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_map_api_key, array(), '1.0.0', true );
		wp_enqueue_script( 'rakibcv-gmap', get_template_directory_uri() . '/assets/js/gmap.js', array('jquery'), '1.0.0', true );
	}

	/*Custom JS*/
  
	$custom_js = get_field( 'custom_js', 'options' );
	if ( $custom_js ) {
		wp_add_inline_script('rakibcv-scripts', $custom_js);
	}
}
add_action( 'wp_enqueue_scripts', 'rakibcv_scripts' );
