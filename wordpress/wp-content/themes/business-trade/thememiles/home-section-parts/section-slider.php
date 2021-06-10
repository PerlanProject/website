<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeMiles
 * @subpackage ThemeMiles
 */

$business_trade_slider_section_option = business_trade_get_option('business_trade_homepage_slider_option');

if ( $business_trade_slider_section_option == 'show' ) {

    $business_trade_slides_data = json_decode( business_trade_get_option('business_trade_slider_option'));
    $post_in = array();
    
    $business_trade_homepage_slider_title_option     = business_trade_get_option('business_trade_homepage_slider_title_option');

    $business_trade_homepage_slider_tagline_option   = business_trade_get_option('business_trade_homepage_slider_tagline_option');
   
    $i=0;

        $slides_other_data = array();
        if( is_array( $business_trade_slides_data ) ){
            foreach ( $business_trade_slides_data as $slides_data ){
                if( isset( $slides_data->selectpage ) && !empty( $slides_data->selectpage ) ){
                    $post_in[] = $slides_data->selectpage;
                    $slides_other_data[$slides_data->selectpage] = array(
                           'button_text' =>$slides_data->button_text,
                           'button_link' =>$slides_data->button_link,
                    );

                   $i++; 
                }

                
            }
        }
        if( !empty( $post_in )) :
            $business_trade_slider_page_args   = array(
                'post__in'            => $post_in,
                'orderby'             => 'post__in',
                'posts_per_page'      => count( $post_in ),
                'post_type'           => 'page',
                'no_found_rows'       => true,
                'post_status'         => 'publish'
            );
            $slider_query = new WP_Query( $business_trade_slider_page_args );
            /*The Loop*/
            if ( $slider_query->have_posts() ):
                ?> 
            
               <!-- Start Slider Section -->
                 <div class="slider-area slider-one-style">
                        <div class="bend niceties preview-1">
                           <div id="ensign-nivoslider-3" class="slides">
                              <?php
                              $i=1;
                              while( $slider_query->have_posts() ):$slider_query->the_post();
                             
                                if (has_post_thumbnail()) {
                                              
                                  $image_id = get_post_thumbnail_id();
                              
                                  $image_url = wp_get_attachment_image_src($image_id, 'full', true);

                                  $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                  ?>
                                    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($alt); ?>" title="#slider-direction-<?php echo esc_attr($i); ?>"/>
                                
                                <?php }
                               $i++; endwhile;
                            
                             wp_reset_postdata();?>
                            
                            </div>
                         
                           <?php

                            $k = 1;
                             while( $slider_query->have_posts() ):$slider_query->the_post();
                                $slides_single_data = $slides_other_data[get_the_ID()];
                            ?>
                                 <div id="slider-direction-<?php echo $k; ?>" class="t-cn slider-direction">
                                      <div class="slider-content s-tb slide-1">
                                          <div class="title-container s-tb-c">
                                              <div class="container">
                                                  <?php 
                                                     if( $business_trade_homepage_slider_title_option != 1 ) 
                                                  { ?>
                                                   
                                                      <div class="large-title">

                                                        <?php the_title(); ?>
                                                      
                                                       </div>

                                            <?php } 

                                                  if( $business_trade_homepage_slider_tagline_option != 1)

                                                  {
                                                  
                                                  ?>
                                                   <?php 
                                                      the_content();
                                                      wp_link_pages( array(
                                                          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),
                                                          'after'  => '</div>',
                                                        ) );

                                                    ?>

                                            <?php } 

                                              if( !empty($slides_single_data['button_text']))

                                               { 
                                            ?> 
                                                  <div class="slider-btn-area">
                                                      <a href="<?php echo esc_url($slides_single_data['button_link']); ?>" class="btn-fill-round"><?php echo esc_html($slides_single_data['button_text'] ) ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                  </div>

                                         <?php } ?> 
                                           
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                            <?php $k++;
                             endwhile;
                             wp_reset_postdata();
                        ?> 
                      </div>
                  </div>
    <?php  endif;  endif;
} ?>