<?php
/**
 * ThemeMiles default theme options.
 *
 * @package Business_Trade
 * @subpackage ThemeMiles
 */

if ( !function_exists('business_trade_get_default_theme_options' ) ) :

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function business_trade_get_default_theme_options()
    {

        $default = array();

        // Homepage Slider Section
        $default['business_trade_homepage_slider_option']               = 'hide';
        $default['business_trade_slider_cat_id']                        = 0;
        $default['business_trade_no_of_slider']                         = 3;
        $default['business_trade_slider_get_started_txt']               = esc_html__('Get Started!', 'business-trade');
        $default['business_trade_slider_get_started_link']              = '#';
        $default['business_trade_homepage_slider_type']                 = 'default';
        $default['business_trade_homepage_slider_title_option']         = 0;
        $default['business_trade_homepage_slider_tagline_option']       = 0; 

        $default['business_trade_primary_color']                        = '#cb011b';

        $default['business_trade_overlay_bg_color']                     = 'rgba(3,23,34,.75)';

        $default['business_trade_slider_text_color']                   = '#222222';
       

       // Contact Us page.
        $default['business_trade_address']          =  esc_html__('98-23 Horace Harding Expy', 'business-trade');
        $default['business_trade_email_option']     =  esc_html__('thememiles@gmail.com', 'business-trade');
        $default['business_trade_phone_option']     =  esc_html__('(01) 800 433 633', 'business-trade');
        $default['business_trade_fax_option']       =  esc_html__('(123) 123 005040', 'business-trade'); 
      
        // footer copyright.
        $default['business_trade_copyright']                            = esc_html__('Copyright All Rights Reserved', 'business-trade');
        $default['business_trade_footer_menu']                          = 0;
        $default['business_trade_footer_go_to_top']                     = 1;
                                                    
        // Home Page Top header Info.
        $default['business_trade_top_header_section']                   = 'show';
        $default['business_trade_top_header_section_phone_number_icon'] = 'fas fa-phone-volume';
        $default['business_trade_top_header_phone_no']                  = '';
        $default['business_trade_address_icon']                         = 'fa-map-marker-alt fas';
        $default['business_trade_top_header_address']                   = '';
        $default['business_trade_time_icon']                            = 'far fa-clock';
        $default['business_trade_top_header_time']                      = '';
        $default['business_trade_social_link_hide_option']              = 0;
        $default['business_trade_post_request_quote_text']              = esc_html__('Request A Quote', 'business-trade');
        $default['business_trade_request_quote_link']                   = "";
		
        // Blog.
        $default['business_trade_sidebar_layout_option']                = 'right-sidebar';
        $default['business_trade_blog_title_option']                    = esc_html__('Latest Blog', 'business-trade');
        $default['business_trade_blog_excerpt_option']                  = 'excerpt';
        $default['business_trade_description_length_option']            = 40;
        $default['business_trade_exclude_cat_blog_archive_option']      = '';
        $default['business_trade_read_more_text_blog_archive_option']   = esc_html__('Read More', 'business-trade');
        $default['business_trade_featured_image_blog_page']             = 0;
        $default['business_trade_meta_options_blog_page']               = 1;
        $default['business_trade_breadcrumb_setting_option']            = 'simple';
        $default['business_trade_hide_breadcrumb_front_page_option']    = 0;
         $default['business_trade_hide_breadcrumb_whole_section_front_page_option']    = 0;
        $default['business_trade_columns_option']                       = 'large-image';
     
        // Details page.
        $default['business_trade_show_feature_image_single_option']     = 0;
        $default['business_trade_meta_fields_single_option']            = 0;
        $default['business_trade_show_feature_image_single_page']       = 0; 
       
        //Related Posts
        $default['business_trade_related_post_show_hide']              = 0;
        $default['business_trade_related_post_title']                  = esc_html__('Related Posts', 'business-trade');
        $default['business_trade_related_hide_featured_image']          = 1; 
        $default['business_trade_related_posts_title_show']             = 1; 
        $default['business_trade_related_posts_meta_options']           = 1;

    
       //extra options
        $default['business_trade_front_page_hide_option']               = 0;
        $default['business_trade_post_search_placeholder_option']       = esc_html__('Search Here', 'business-trade');
        $default['business_trade_header_search_icon']                   = 1;
        $default['business_trade_contact_shortcode_option']             = '';
       $default['business_trade_slider_option']                         = '';

       // Pass through filter.
        $default                                               = apply_filters( 'business_trade_get_default_theme_options', $default );
        return $default;
    }
endif;
