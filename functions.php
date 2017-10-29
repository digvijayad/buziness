<?php
/**
 * Buziness functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Buziness
 */

if ( ! function_exists( 'buziness_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function buziness_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Buziness, use a find and replace
		 * to change 'buziness' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'buziness', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'buziness' ),
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
		add_theme_support( 'custom-background', apply_filters( 'buziness_custom_background_args', array(
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
			'height'      => 150,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		) );


		buziness_image_sizes();

	} /*End Function- buziness_setup() */

endif;
add_action( 'after_setup_theme', 'buziness_setup' );


function buziness_image_sizes(){
/*************************************************************************************************************************************************
		*image Corpping
**************************************************************************************************************************************************/

		//image size for Slider banner crop
		add_image_size( 'buziness_slider_image', 1600, 660, true );

		//image size for banner
		add_image_size( 'buziness_banner_image_size', 1920, 287, true );

		//image size for portfolio
		add_image_size( 'buziness_portfolio_image_size', 380, 380, true );

		//image size for t-blog
		add_image_size( 'buziness_blog_image_size', 370, 235, true );

		//image size for about-us
		add_image_size( 'buziness_about_us_image_size', 585, 389, true );

		//image size for offers
		add_image_size( 'buziness_offer_image_size', 150, 150, true);
}




/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buziness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'buziness_content_width', 640 );
}
add_action( 'after_setup_theme', 'buziness_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buziness_widgets_init() {

	buziness_register_sidebar(esc_html__( 'Right Sidebar', 'buziness' ), esc_html__( 'Show Right Sidebar.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Left Sidebar', 'buziness' ), esc_html__( 'Show Left Sidebar.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer 1', 'buziness' ), esc_html__( 'Show Widgets on the Top Left Footer.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer 2', 'buziness' ), esc_html__( 'Show Widgets on the Top center Footer.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer 3', 'buziness' ), esc_html__( 'Show Widgets on the Top Right Footer.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer 1 Home', 'buziness' ), esc_html__( 'Show Widgets on the Top Left homepage Footer.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer 2 Home', 'buziness' ), esc_html__( 'Show Widgets on the Top center homepage Footer.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer 3 Home', 'buziness' ), esc_html__( 'Show Widgets on the Top Right homepage Footer.', 'buziness' ));
	buziness_register_sidebar(esc_html__( 'Footer Middle', 'buziness' ), esc_html__( 'Show Widgets on the Middle Footer.', 'buziness' ));

}
add_action( 'widgets_init', 'buziness_widgets_init' );

function buziness_register_sidebar($text, $description){

	register_sidebar( array(
		'name'          => $text,
		'id'            => strtolower(preg_replace('/\s+/', '-', $text)),
		'description'   => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

/**
 * Enqueue scripts and styles.
 */
function buziness_scripts() {
	wp_enqueue_style( 'buziness-style', get_stylesheet_uri() );
	wp_enqueue_style( 'buziness-colors', get_template_directory_uri() . '/css/colors.css' );
	// wp_enqueue_style( 'buziness-colors',get_template_directory_uri() . '/css/colors.css'  );


	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri().'/css/owl.carousel.css');   
	wp_enqueue_style('owl-theme-default', get_template_directory_uri().'/css/owl.theme.default.css');
	

	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Assistant|Bree+Serif|Calligraffitti');

	wp_enqueue_script( 'buziness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'buziness-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// I'm using a custom handle here because both resources are coming in one request
	wp_enqueue_script('jsdelivr-scripts', 'https://cdn.jsdelivr.net/g/jquery.waypoints@2.0.5,jquery.counterup@1.0', array('jquery'), null, true );
	// wp_enqueue_script('wow-scripts', 'https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js', array('jquery'), null, true );
	// 
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carausel.js', array(), '2.0.0', true );
	wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js', array(), '1.0.0' , true);
	wp_enqueue_script( 'buziness-main-js', get_template_directory_uri() . '/js/buziness.js', array('jquery'), '20151215', true );

	// If you use a custom handle, you might want to dequeue all CDN scripts.
	// That way, they won't potentially also load twice from another enqueue plugin.
	wp_dequeue_script('waypoints');
	wp_dequeue_script('counterup');
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// require get_template_directory() . '/inc/colors.php';
}
add_action( 'wp_enqueue_scripts', 'buziness_scripts' );

function add_admin_scripts( $hook ) {

	global $typenow;

	// if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
		if ( $typenow =='post' /*=== $post->post_type*/ ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'myscript', get_stylesheet_directory_uri().'/js/admin/custom-image-upload.js', array( 'wp-color-picker' )  );
		}
	// }
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

/** 
	Add fallback scripts
 */
function bz_fallback_scritps_conditionals($tag, $handle, $src ){
	if('jsdelivr-scripts' === $handle) {
		$fallback_scr = get_template_directory_uri() . '/js/waypoint-counterup-fallback.js';
		$output = $tag;
		$output .= "\n" . '<script>jQuery.fn.model || document.write(\'<script src="';
		$output .= $fallback_scr . '"><\/script>\');</script>';
	}
	else {
		$output = $tag;
	}

	return $output;
}
add_filter('script_loader_tag', 'bz_fallback_scritps_conditionals', 11 ,3);

/**
 * Registers an editor stylesheet for the theme.
 */
function buziness_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'buziness_add_editor_styles' );


/**
 * Implement the Custom Helper Functions feature.
 */
require get_template_directory() . '/inc/buziness-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load  custom meta-box file .
 */
require get_template_directory() . '/inc/custom-meta-box.php';


/**
 * Load Custom Theme Color Scheme
 */
require get_template_directory() . '/inc/color-scheme.php';
new Buziness_Color_Scheme;


/** Google iframe Sanitization */

function buziness_expanded_alowed_tags() {
	//$allowed = wp_kses_allowed_html( 'post' );

	// iframe
	$allowed['iframe'] = array(
		'src'             => array(),
		'height'          => array(),
		'width'           => array(),
		'frameborder'     => array(),
		'allowfullscreen' => array(),

	);

	$allowed['a'] = array(

            'href' => array(),
            'rel' => array(),
            'name' => array(),
            'target' => array(),
            'class' => array(),
            'id' => array(),
		);
	$allowed['span'] = array(
			'class' => array(),
			'id' 	=> array(),
			'style' => array(),
 		);

	$allowed['br'] = array();

	return $allowed;
}

/** wp_kses allow variable function ends here */

/** Text area sanitizaation */
function buziness_textarea_sanitize($input, $input_allowed = '')
{	
	if( $input_allowed == '' ){

	$allowed_text = buziness_expanded_alowed_tags();
	}
	else {
		$allowed_text = $input_allowed;
	}

	$output = wp_kses( $input, $allowed_text );

	return $output;
}

/** defining excerpt: */

function buziness_excerpt_length( $length = '' ) {

	if ( isset( $GLOBALS['buziness_excerpt_length'] ) && $GLOBALS['buziness_excerpt_length'] > 0 ) {
		return $GLOBALS['buziness_excerpt_length'];
	} else {
		return 50;
	}
}
add_filter( 'excerpt_length', 'buziness_excerpt_length', 99 );

/**
* Filter the excerpt "read more" string.
*
* @param string $more "Read more" excerpt string.
* @return string (Maybe) modified "read more" excerpt string.
*/
function buziness_excerpt_more( $more = '' ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'buziness_excerpt_more' );

/**
* Add custom excerpt length
* @param $length
*/
function buziness_add_excerpt_length( $length ){
	$length = absint( $length );
	$GLOBALS['buziness_excerpt_length'] = $length;
}

/**
* REMOVE custom excerpt length
*/
function buziness_remove_excerpt_length (){
	if ( isset( $GLOBALS['buziness_excerpt_length'] ) ) {
		unset( $GLOBALS['buziness_excerpt_length'] );
	}
}

