<?php
/**
 * Business Trade functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business_Trade
 */

if ( ! function_exists( 'business_trade_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function business_trade_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Business Trade, use a find and replace
		 * to change 'business-trade' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'business-trade');

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
			'primary'     => esc_html__( 'Primary', 'business-trade' ),
			'social-link' => esc_html__( 'Social Menu', 'business-trade' ),
			
		) );


		/**
		 * Register support for Gutenberg wide width in your theme
		 */
		
		  add_theme_support( 'align-wide' );

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
		add_theme_support( 'custom-background', apply_filters( 'business_trade_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		 add_theme_support( 'align-wide' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 46,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		
	}
endif;
add_action( 'after_setup_theme', 'business_trade_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_trade_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'business_trade_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_trade_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_trade_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business-trade' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'business-trade' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

   register_sidebar(array(
        'name'          => esc_html__('Home Page Widget Area', 'business-trade'),
        'id'            => 'business-trade-home-page',
        'description'   => esc_html__('Add widgets here to appear in Home Page. First Select Front Page and Blog Page From Appearance > Homepage Settings', 'business-trade'),
        'before_widget' => '',
        'after_widget'  => '',

    ));

   
    register_sidebar(array(
		'name'          => esc_html__('Footer 1', 'business-trade'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Add widgets here.', 'business-trade'),
		'before_widget' => '<section id="%1$s" class="widget %2$s footer-box">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title title-bar-footer">',
		'after_title'   => '</h2>',
    ));

    register_sidebar(array(
		'name'          => esc_html__('Footer 2', 'business-trade'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Add widgets here.', 'business-trade'),
		'before_widget' => '<section id="%1$s" class="widget %2$s footer-box">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title title-bar-footer">',
		'after_title'   => '</h2>',
    ));

    register_sidebar(array(
		'name'          => esc_html__('Footer 3', 'business-trade'),
		'id'            => 'footer-3',
		'description'   => esc_html__('Add widgets here.', 'business-trade'),
		'before_widget' => '<section id="%1$s" class="widget %2$s footer-box">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title title-bar-footer">',
		'after_title'   => '</h2>',
    ));


    register_sidebar(array(
		'name'          => esc_html__('Footer 4', 'business-trade'),
		'id'            => 'footer-4',
		'description'   => esc_html__('Add widgets here.', 'business-trade'),
		'before_widget' => '<section id="%1$s" class="widget %2$s footer-box">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title title-bar-footer">',
		'after_title'   => '</h2>',
    ));

}
add_action( 'widgets_init', 'business_trade_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function business_trade_scripts() {

	

	/*google font  */
	wp_enqueue_style( 'business-trade-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto:400,500,700', array(), null );

	/*google font  */
	wp_enqueue_style( 'business-trade-all', 'https://use.fontawesome.com/releases/v5.0.7/css/all.css', array(), null );

	//normalize stylesheet.
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css' );

	//Bootstrap stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

    //Font Awesome stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	
    //Animate stylesheet.
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );

	//Owl carousel stylesheet.
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/vendor/OwlCarousel/owl.carousel.min.css' );

	//owl-theme carousel stylesheet.
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/assets/vendor/OwlCarousel/owl.theme.default.min.css' );

   
	//meanmenu stylesheet.
	wp_enqueue_style( 'business-trade-meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.min.css' );

	//nivo-slider stylesheet.
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri() . '/assets/vendor/slider/css/nivo-slider.css' );

	//preview stylesheet.
	wp_enqueue_style( 'preview', get_template_directory_uri() . '/assets/vendor/slider/css/preview.css' );

	//select2-min stylesheet.
	wp_enqueue_style( 'business-trade--select2-min', get_template_directory_uri() . '/assets/css/select2.min.css' );

	wp_enqueue_style( 'business-trade-style', get_stylesheet_uri() );

	/*RTL CSS*/
	wp_style_add_data( 'business-trade-style', 'rtl', 'replace' );


	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'business-trade-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.5', true );

	wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'nivo-slider', get_template_directory_uri() . '/assets/vendor/slider/js/jquery.nivo.slider.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'home', get_template_directory_uri() . '/assets/vendor/slider/home.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/vendor/OwlCarousel/owl.carousel.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'business-trade-meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.min.js', array('jquery'), '20151215', true );

    $go_to_top = business_trade_get_option('business_trade_footer_go_to_top'); 
	
	if( $go_to_top == 1 ){
  
    	 wp_enqueue_script( 'scrollUp', get_template_directory_uri() . '/assets/js/jquery.scrollUp.min.js', array('jquery'), '20151215', true );

    	 wp_enqueue_script( 'scrollup', get_template_directory_uri() . '/assets/js/scrollup.js', array('jquery'), '20151215', true );
	}


	wp_enqueue_script( 'business-trade-select2', get_template_directory_uri() . '/assets/js/select2.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'business-trade-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'business-trade-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'business-trade-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), time(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'business_trade_scripts' );


/**
 * Implement the default Function.
 */
require get_template_directory() . '/thememiles/customizer/default.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/thememiles/core/custom-header.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/thememiles/core/template-tags.php';


require get_template_directory() . '/thememiles/core/extras.php';

/**
 * Customizer Home layout.
 */
require get_template_directory() . '/thememiles/layouts/homepage-layout/business-trade-home-layout.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/thememiles/core/theme-function.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/thememiles/core/customizer.php';

include get_template_directory() . '/thememiles/customizer-repeater/customizer-control-repeater.php';


include get_template_directory() . '/thememiles/hooks/dynamic-css.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/thememiles/core/jetpack.php';
}

/**
 * Run ajax request.
 */
if ( ! function_exists('business_trade_wp_pages_plucker') ) :

    /**
    * Sending pages with ids
    */
    function business_trade_wp_pages_plucker()
    {
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );

        $ids = wp_list_pluck( $pages, 'post_title', 'ID' );

         wp_send_json($ids);
    }

endif;


add_action( 'wp_ajax_business_trade_wp_pages_plucker', 'business_trade_wp_pages_plucker' );

add_action( 'wp_ajax_nopriv_business_trade_wp_pages_plucker', 'business_trade_wp_pages_plucker' );



