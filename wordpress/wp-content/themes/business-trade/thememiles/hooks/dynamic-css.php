<?php
/**
 * Dynamic css
 *
 * @package ThemeMiles
 * @subpackage ThemeMiles
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('business_trade_dynamic_css') ):
    function business_trade_dynamic_css(){
   

    
    $business_trade_slider_text_color         = esc_attr( business_trade_get_option('business_trade_slider_text_color') );
   
    
    $business_trade_primary_color           = esc_attr( business_trade_get_option('business_trade_primary_color') );

    $business_trade_overlay_color           = esc_attr( business_trade_get_option('business_trade_overlay_bg_color') );

 
     $custom_css                  = '';


    /***********************************************************************************
                       Slider Text color
    ***********************************************************************************/  

         $custom_css .= ".slider-area .nivoSlider .slider-content .large-title,.slider-area .nivoSlider .nivo-caption{
                 color: " . $business_trade_slider_text_color . ";
               
             }
            ";

     /**************************************************************************************
                            Overlay color
    ***************************************************************************************/  
   

      
         $custom_css .= ".service-slider-one-area .single-feature-slide .feature-slide-content,.overlay-dark:after, .request-call-one-area{
             background-color: " . $business_trade_overlay_color . "!important;}
        ";
        


    /***********************************************************************************
                       Primary color
    ***********************************************************************************/  


     $custom_css .= ".stick
     {
        border: 2px solid " . $business_trade_primary_color . ";
    }
    ";

   
     $custom_css .= ".woocommerce-message
     {
        border-top-color: " . $business_trade_primary_color . ";
    }
    ";

    $custom_css .= ".stick,.owl-theme .owl-controls .owl-nav > div,.owl-theme .owl-controls .owl-nav > div:hover,.testimonial-two-area .arrow-left-right .owl-controls .owl-nav > div:hover,.main-menu-area nav > ul > li ul.sub-menu li
     {
        border: 1px solid " . $business_trade_primary_color . ";
    }
    ";

    
    $custom_css .= ".menu-four-style .get-quote,.slider-area .nivoSlider .slider-content .slider-btn-area .btn-fill-round:hover,.slider-area .nivoSlider .slider-content .slider-btn-area .btn-fill-round, .waste-time-area,.about-one-area .about-content-center .about-content h2:after,
       .owl-theme .owl-controls .owl-nav > div:hover,.testimonial-two-area .arrow-left-right .owl-controls .owl-nav > div:hover,.our-expert-slider-area .single-expert:hover,.request-call-one-area,.sidebar .widget h2.widget-title:after,#scrollUp,.sidebar .sidebar-box .download .button-dow a,
       .sidebar .sidebar-box .download .button-dow a:hover,.sidebar .sidebar-box .sidebar-search form button,.section-title h2:after,.financial-report-one .financial-report h2:after,
       .owl-theme .owl-controls .owl-nav > div:hover,.everest-forms button[type=submit]:hover, .everest-forms input[type=submit]:hover,.news-details-layout .item-comments .comment-form input[type=submit],.news-details-layout .item-comments .comment-form input[type=submit]:hover,
       .news-layout-1 .single-item .item-image .date,.slider-area .nivoSlider .nivo-directionNav a.nivo-prevNav:hover:before,.asked-question-two-area .asked-accordion .panel-default .panel-heading.active,.asked-question-two-area .asked-accordion h2:after,.btn-default-black:hover,.contact-area h2:after,
       .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce span.onsale,.case-layout-detail .detail-item h2:after,
       .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
       .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
       request-call-one-area,.main-menu-area nav > ul > li ul.sub-menu li a:focus,.main-menu-area nav > ul > li ul.sub-menu li,.main-menu-area nav > ul > li ul.sub-menu li a:hover, .main-menu-area nav > ul > li ul.sub-menu li a:focus
      {
       background-color: " . $business_trade_primary_color . ";}
    ";

  
   $custom_css .= ".banner-one-area a.btn-default-black, .title-bar:after , .footer-bottom-area .footer-box .stylish-input-group .input-group-addon button
     {
         background-color: " . $business_trade_primary_color . " !important;
    }
    ";

   
    $custom_css .= ".header-address li i,.sidebar ul li:before, .sidebar .widget_recent_entries ul li:before, .sidebar .widget_recent_comments ul li:before, .sidebar .widget.widget_archive ul li:before, .sidebar .widget.widget_categories ul li:before,.copyright a,
    .main-menu-area nav > ul > li.current-menu-parent a

    {
         color: " . $business_trade_primary_color . ";
       
     }
    ";

    
    $custom_css .= ".cart-area > a > span{
        
          background-color: " . $business_trade_primary_color . ";
       
     }
    ";


    $custom_css .= ".woocommerce-info,.woocommerce-error{
        
          border-top-color: " . $business_trade_primary_color . ";
       
     }
    ";
  
   $custom_css .= ".counter-area .counter-content p{
        
          color:#FFF ;
       
     }
    ";
  

    $custom_css .= "
    .our-expert-slider-area .single-expert .item-content .position, .menu-four-style .main-menu-area nav > ul > li.current-menu-item a, blockquote:before,.about-one-area .about-content-center .about-content h3,.owl-theme .owl-controls .owl-nav > div i,.sidebar .widget.widget_archive ul li:before, .sidebar .widget.widget_categories ul li:before,.social-links ul li a:before,.contact-area .contact-info ul li i,.woocommerce-error::before, .news-details-layout .item-header ul.item-info li i,.woocommerce-message::before

    {
        color: " . $business_trade_primary_color . ";}
    ";
    $custom_css .= ".section-14-box .underline,
   .item blockquote img,
   .btn-primary,
   .portfolioFilter a,
   .btn-primary:hover,
   button,  
   input[type='button'], 
   input[type='reset'], 
   input[type='submit'],
   .testimonials .content .avatar,
   #quote-carousel .carousel-control.left, 
   #quote-carousel .carousel-control.right,
   header .navbar-menu .navbar-right .dropdown-menu,
   .woocommerce nav.woocommerce-pagination ul li a:focus,
   .woocommerce nav.woocommerce-pagination ul li a:hover,
   .woocommerce nav.woocommerce-pagination ul li span.current
   .woocommerce a.button, .woocommerce #respond input#submit.alt, 
   .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt
   {
       border-color: " . $business_trade_primary_color . ";}
    ";
    /*------------------------------------------------------------------------------------------------- */
    /*custom css*/
    wp_add_inline_style('business-trade-style', $custom_css);
}
endif;
add_action('wp_enqueue_scripts', 'business_trade_dynamic_css', 99);