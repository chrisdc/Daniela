<?php
/**
 * Daniela functions and definitions
 *
 * @package Daniela
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function daniela_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'daniela_content_width', 640 );
}
add_action( 'after_setup_theme', 'daniela_content_width', 0 );

if ( ! function_exists( 'daniela_modify_content_width' ) ) :
/**
 * Adjust content_width value for full width template.
 */
function daniela_modify_content_width() {
	global $content_width;

	if ( is_page_template( 'page-templates/full-width.php' ) || ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1020;
	}
}
endif;
add_action( 'template_redirect', 'daniela_modify_content_width' );

if ( ! function_exists( 'daniela_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function daniela_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Daniela, use a find and replace
	 * to change 'daniela' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'daniela', get_template_directory() . '/languages' );

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
	 * Enqueue editor style sheet.
	 */
	$font_url = str_replace( ',', '%2C', daniela_fonts_url() );
	add_editor_style( 'css/editor-style.css' );
	add_editor_style( $font_url );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 668, 445, true );
	add_image_size( 'daniela-full-width', 1020, 612, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'daniela' ),
		'social'  => esc_html__( 'Social Media Menu', 'daniela' ),
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

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'daniela_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // daniela_setup
add_action( 'after_setup_theme', 'daniela_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function daniela_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'daniela' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget 1', 'daniela' ),
		'id'            => 'front-page-1',
		'description'   => esc_html__( 'The first (leftmost) sidebar used by front-page.php', 'daniela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget 2', 'daniela' ),
		'id'            => 'front-page-2',
		'description'   => esc_html__( 'The second (central) sidebar used by front-page.php', 'daniela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget 3', 'daniela' ),
		'id'            => 'front-page-3',
		'description'   => esc_html__( 'The third (rightmost) sidebar used by front-page.php', 'daniela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'daniela_widgets_init' );

if ( ! function_exists( 'daniela_fonts_url' ) ) :
/**
 * Register Google fonts for Daniela.
 *
 * @since Daniela 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function daniela_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Open Sans font: on or off', 'daniela' ) ) {
		$fonts[] = 'Open Sans:400italic,700italic,400,700';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Playfair Display font: on or off', 'daniela' ) ) {
		$fonts[] = 'Playfair Display:700italic,400,700,900';
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = esc_attr_x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'daniela' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function daniela_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'daniela-fonts', daniela_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3' );

	wp_enqueue_style( 'daniela-style', get_stylesheet_uri() );

	wp_enqueue_script( 'daniela-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'daniela-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'daniela_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
