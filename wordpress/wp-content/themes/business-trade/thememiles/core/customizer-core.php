<?php

/**
 * Top Header Section Hide/Show  options
 *
 * @since Thememiles 1.0.0
 *
 * @param null
 * @return array $business_trade_show_top_header_section_option
 *
 */
if (!function_exists('business_trade_show_top_header_section_option')) :
    function business_trade_show_top_header_section_option()
    {
        $business_trade_show_top_header_section_option = array(
            'show' => esc_html__('Show', 'business-trade'),
            'hide' => esc_html__('Hide', 'business-trade')
        );
        return apply_filters('business_trade_show_top_header_section_option', $business_trade_show_top_header_section_option);
    }
endif;


/**
 * Show/Hide Feature Image  options
 *
 * @since Thememiles 1.0.0
 *
 * @param null
 * @return array $business_trade_show_feature_image_option
 *
 */
if (!function_exists('business_trade_show_feature_image_option')) :
    function business_trade_show_feature_image_option()
    {
        $business_trade_show_feature_image_option = array(
            'show' => esc_html__('Show', 'business-trade'),
            'hide' => esc_html__('Hide', 'business-trade')
        );
        return apply_filters('business_trade_show_feature_image_option', $business_trade_show_feature_image_option);
    }
endif;


/**
 * Slider  options
 *
 * @since Thememiles 1.0.0
 *
 * @param null
 * @return array $business_trade_slider_option
 *
 */
if (!function_exists('business_trade_slider_option')) :
    function business_trade_slider_option()
    {
        $business_trade_slider_option = array(
            'show' => esc_html__('Show', 'business-trade'),
            'hide' => esc_html__('Hide', 'business-trade')
        );
        return apply_filters('business_trade_slider_option', $business_trade_slider_option);
    }
endif;


/**
 * Sidebar layout options
 *
 * @since Thememiles 1.0.0
 *
 * @param null
 * @return array $business_trade_sidebar_layout
 *
 */
if (!function_exists('business_trade_sidebar_layout')) :
    function business_trade_sidebar_layout()
    {
        $business_trade_sidebar_layout = array(
            'right-sidebar'   => esc_html__('Right Sidebar', 'business-trade'),
            'left-sidebar'    => esc_html__('Left Sidebar', 'business-trade'),
            'no-sidebar'      => esc_html__('No Sidebar', 'business-trade'),
        );
        return apply_filters('business_trade_sidebar_layout', $business_trade_sidebar_layout);
    }
endif;

/**
 * Blog/Archive Description Option
 *
 * @since Thememiles 1.0.0
 *
 * @param null
 * @return array $business_trade_blog_excerpt
 *
 */
if ( !function_exists( 'business_trade_blog_excerpt' ) ) :
    
    function business_trade_blog_excerpt()
    
    {
        $business_trade_blog_excerpt = array(
            'excerpt' => esc_html__('Excerpt', 'business-trade'),
            'content' => esc_html__('Content', 'business-trade'),

        );
        return apply_filters('business_trade_blog_excerpt', $business_trade_blog_excerpt);
    }
endif;

/**
 * Header Search Option
 *
 * @since Thememiles 1.0.0
 *
 * @param null
 * @return array $business_trade_header_search
 *
 */
if ( !function_exists( 'business_trade_header_search' ) ) :
    
    function business_trade_header_search()
    
    {
        $business_trade_header_search = array(
            'show' => esc_html__('Show Search', 'business-trade'),
            'hide' => esc_html__('Hide Search', 'business-trade'),

        );
        return apply_filters('business_trade_header_search', $business_trade_header_search);
    }
endif;


/**
 * Breadcrumb  display option options
 *
 * @since Business Trade 1.0.0
 *
 * @param null
 * @return array $business_trade_show_breadcrumb_option
 *
 */
if (!function_exists('business_trade_show_breadcrumb_option')) :
    function business_trade_show_breadcrumb_option()
    {
        $business_trade_show_breadcrumb_option = array(
            'simple'    => esc_html__( 'Theme Default','business-trade'),
            'advanced'  => esc_html__( 'Advanced : Breadcrumb NavXT','business-trade'),
            'rank-math' => esc_html__( 'Rank Math : Breadcrumb','business-trade'),
            'yoast-seo' => esc_html__( 'Yoast Seo : Breadcrumb','business-trade'),
            'disable'   => esc_html__( 'Disable','business-trade')

            
        );
        return apply_filters('business_trade_show_breadcrumb_option', $business_trade_show_breadcrumb_option);
    }
endif;