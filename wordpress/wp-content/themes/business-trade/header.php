<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until 
 <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Trade
 */

$section_option     = business_trade_get_option('business_trade_top_header_section');
$mobile_icon        = business_trade_get_option('business_trade_top_header_section_phone_number_icon');
$mobile_value       = business_trade_get_option('business_trade_top_header_phone_no'); 
$address_icon       = business_trade_get_option('business_trade_address_icon');
$address_value      = business_trade_get_option('business_trade_top_header_address');
$time_icon          = business_trade_get_option('business_trade_time_icon');
$time_icon_value    = business_trade_get_option('business_trade_top_header_time');
$social_menu        = business_trade_get_option('business_trade_social_link_hide_option');
$search_icon        = business_trade_get_option('business_trade_header_search_icon'); 
$request_quoto_text = business_trade_get_option('business_trade_post_request_quote_text'); 
$request_quoto_link = business_trade_get_option('business_trade_request_quote_link'); 
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
  if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
    }
    else { do_action( 'wp_body_open' ); }

    ?>   
    <div id="wrapper" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business-trade' ); ?></a>

    <!-- Header Area Start Here -->
    <header>
        <div class="header header-four-style">
        <?php if ($section_option =='show') { ?>
                <div class="header-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="logo-area">
                                    <?php
                                if (has_custom_logo()) { ?>
                                   
                                       <h1 class="custom_logo"> <?php the_custom_logo(); ?></h1>
                                            
                                        <?php } else 

                                          {
                                            if (is_front_page() && is_home()) : ?>
                                                <h1 class="site-title">
                                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                                </h1>
                                            <?php else : ?>
                                          
                                                <h1 class="site-title">
                                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                                </h1>
                                          
                                                <?php
                                          
                                            endif;
                                          
                                            $description = get_bloginfo('description', 'display');
                                          
                                            if ($description || is_customize_preview()) : ?>
                                                <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                                                <?php
                                            endif;
                                        } 
                                        ?>
                                </div>
                            </div>
                            <?php
                              if(!empty($mobile_value) || !empty($address_value) || !empty($time_icon_value))
                              {
                            ?>
                                <div class="col-lg-8 col-md-8 col-sm-9">
                                    <ul class="header-address">
                                        
                                        <?php
                                          if(!empty($mobile_value))
                                          {
                                         ?>
                                             <li><i class="<?php echo esc_attr( $mobile_icon ); ?>"></i><a class="mobile_number" href="tel:<?php echo esc_attr($mobile_value); ?>"><?php echo wp_kses_post($mobile_value); ?></a></li>
                                          
                                    <?php }

                                     if(!empty($address_value))
                                          {
                                      ?>  

                                            <li><i class="<?php echo esc_attr( $address_icon ); ?>" aria-hidden="true"></i><a class="address" href="#"><?php echo wp_kses_post($address_value); ?></a></li>
                                       <?php

                                         }
                                      
                                          if(!empty($time_icon_value))
                                          {
                                      
                                         ?>      
                                          
                                            <li><i class="<?php echo esc_attr( $time_icon ); ?>" aria-hidden="true"></i><a class="opening_hour" href="#"><?php echo wp_kses_post($time_icon_value); ?></a></li>
                                       <?php } ?>     
                                    </ul>
                                </div>
                        <?php } 
                        
                        ?>
                        
                            <div class="col-lg-1 col-md-1 hidden-sm top-header-search">
                                <ul class="nav-top-right">
                                 <?php
                                  if(  $search_icon == 1 )
                                   {
                                    $business_trade_placeholder_text     = '';
                                    $business_trade_placeholder_option   = business_trade_get_option( 'business_trade_post_search_placeholder_option');
                                    if ( !empty( $business_trade_placeholder_option) ):
                                        $business_trade_placeholder_text = 'placeholder="'.esc_attr ( $business_trade_placeholder_option ). '"';
                                    endif; ?>
                                  
                                    <li class="header-search">
                                        <form role="search" id="top-search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                            <input type="search" name="s" class="search-input" <?php echo $business_trade_placeholder_text ;?> required="">
                                            <a href="#" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        </form>
                                    </li>
                                    
                                <?php } 
  
                                ?>    
   
                                </ul>
                            </div>
           
                        </div>
                    </div>
                </div>
        <?php } ?>
            <div class="menu-four-style" id="sticker">
                <div class="container">
                    <div class="menu-full">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="main-menu-area">
                                    <nav>
                                        <?php

                                        if (has_nav_menu('primary')) {
                                            wp_nav_menu(array(
                                                        'theme_location'  => 'primary',
                                                        'container'       => false, 
                                                        'depth'           => 4,
                                                        'menu_class'      => '',
                                                        
                                                    )
                                                );
                                            }
                                
                                        ?>
                                      
                                    </nav>
                                </div>
                            </div>
                            <?php if(!empty($request_quoto_text)) { ?>
                                <div class="col-lg-3 col-md-3 hidden-sm">
                                    <div class="get-quote">
                                        <a href="<?php echo esc_url($request_quoto_link); ?>"><?php echo esc_html($request_quoto_text); ?></a>
                                    </div>
                                </div>
                           <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area Start -->
        <a href="" id="test" class='logo-mobile-menu'>

        </a>
        <div class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                        
                             <?php

                                if (has_nav_menu('primary')) {
                                    wp_nav_menu(array(
                                                'theme_location'  => 'primary',
                                                'container'       => false, 
                                                'depth'           => 4,
                                                'menu_class'      => '',
                                                
                                            )
                                        );
                                    }
                        
                                ?>
                                 
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End -->
    </header>
    <!-- Header Area End Here -->