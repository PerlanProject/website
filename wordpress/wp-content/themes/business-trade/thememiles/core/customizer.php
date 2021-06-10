<?php
/**
 * Thememiles Theme Customizer
 *
 * @package Business_Trade
 * @subpackage Thememiles
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('business_trade_customize_register')) :
    function business_trade_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport         = 'refresh';
        $wp_customize->get_setting('blogdescription')->transport  = 'refresh';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
        $wp_customize->get_setting( 'custom_logo' )->transport    = 'refresh';

        /*default variable used in setting*/
        $default = business_trade_get_default_theme_options();

        /**
         * Customizer setting
         */
        require get_template_directory() . '/thememiles/core/customizer-core.php';
        require get_template_directory() . '/thememiles/customizer/business-trade-customizer-function.php';
        require get_template_directory() . '/thememiles/customizer/business-trade-sanitize.php';
        require get_template_directory() . '/thememiles/customizer/customizer.php';
        require get_template_directory() . '/thememiles/customizer/business-trade-copy-right.php';
        require get_template_directory() . '/thememiles/customizer/business-trade-theme-options.php';
        require get_template_directory() . '/thememiles/customizer/business-trade-header-info-section.php';
        require get_template_directory() . '/thememiles/customizer/business-trade-layout-design-options.php';
       
        require get_template_directory() . '/thememiles/customizer/business-trade-single-page-options.php';

         require get_template_directory() . '/thememiles/customizer/business-trade-color-options.php';

        

    }
    
    add_action('customize_register', 'business_trade_customize_register');

endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

if (!function_exists('business_trade_customize_preview_js')) :
    function business_trade_customize_preview_js()
    {
        wp_enqueue_script('business-trade-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '1.0.1', true);
    }

    add_action('customize_preview_init', 'business_trade_customize_preview_js');

endif;

/**
 * Adding color in Theme Customizer cutom section
 */

function business_trade_customizer_script() {
  
    wp_enqueue_style( 'business-trade-customizer-style', get_template_directory_uri() .'/thememiles/core/css/customizer-style.css'); 
}
add_action( 'customize_controls_enqueue_scripts', 'business_trade_customizer_script' );