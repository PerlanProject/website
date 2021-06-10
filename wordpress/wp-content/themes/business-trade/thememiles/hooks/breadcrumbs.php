<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeMiles
 * @subpackage Business Trade
 */

if (!function_exists('business_trade_breadcrumb')) :

    function business_trade_breadcrumb($post_id)
    {
    
      $breadcrumb_type = business_trade_get_option( 'business_trade_breadcrumb_setting_option');  
      
        
          global $header_imagem,$header_style;
            $header_image = get_header_image();

            if( $header_image ){
                $header_style = 'style="background: url('.esc_url( $header_image ).'); background-size: cover;background-attachment: scroll;background-repeat: no-repeat;background-position: center; padding: 80px 0;"';                 

            } else{

                $header_style = '';
            }
$blog_page_title = business_trade_get_option('business_trade_blog_title_option');
?>         
           <!-- Inner Title banner Start Here -->
          <div class="inner-title-banner">
              <div class="page-title overlay-dark" <?php echo $header_style; ?> >
                  <div class="container">
                     <?php
                          if(is_archive() )
                          {
                            the_archive_title( '<h2>', '</h2>' );
                          }
                         
                          elseif(is_home() )
                         
                          { ?>
                           
                            <h2><?php echo esc_html($blog_page_title); ?></h2>
                    
                      <?php }

                       elseif(is_search() )
                         
                          { ?>
                           
                            <h2>
                               <?php
                                /* translators: %s: search query. */
                                printf( esc_html__( 'Search Results for: %s', 'business-trade' ), '<span>' . get_search_query() . '</span>' );
                                ?>
                           
                            </h2>
                    
                      <?php }
                       
                         else
                         { ?>
                          
                           <h2><?php the_title(); ?></h2>
                       
                       <?php  }
                      
                       if(  $breadcrumb_type == 'simple' )
                           {
                        ?>
                           <div class="breadcrumbs">
                               <?php  business_trade_breadcrumb_trail(); ?>
                           </div>

                      <?php }
                        elseif ( (function_exists('bcn_display')) && ($breadcrumb_type=="advanced")) {
                         ?>
                        <div class="breadcrumbs">
                               <?php  bcn_display(); ?>
                        </div>
                     <?php }
                      elseif ( function_exists('rank_math_the_breadcrumbs') && ( $breadcrumb_type=="rank-math")) { ?>

                       <div class="breadcrumbs">
                               <?php  rank_math_the_breadcrumbs(); ?>
                        </div>
                    
                     <?php }

                     elseif ( (function_exists('yoast_breadcrumb')) && ($breadcrumb_type=="yoast-seo")) { ?>

                       <div class="breadcrumbs">
                               <?php  yoast_breadcrumb(); ?>
                        </div>
                    
                     <?php }


                     ?>     
                  </div>
              </div>
          </div>
          <!-- Inner Title banner End Here -->
   <?php  
        
    }
endif;

add_action('business_trade_breadcrumb_trail', 'business_trade_breadcrumb', 10, 1);    