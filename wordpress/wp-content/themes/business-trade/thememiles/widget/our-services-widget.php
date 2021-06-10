<?php
/**
 * Class for adding Our Services Section Widget
 *
 * @package ThemeMiles
 * @subpackage ThemeMiles
 * @since 1.0.0
 */
if( !class_exists( 'Business_Trade_Our_Services_Widget' ) ){
    
    class Business_Trade_Our_Services_Widget extends WP_Widget
    
    {
        private function defaults()
        {
            /*defaults values for fields*/
            $defaults    = array(
                'title'       => esc_html__('Our Services','business-trade'),
                'read_more'   => esc_html__('Read More','business-trade'),
                'no_of_words' => 30,
                'features'    => ''
            );
            return $defaults;
        }

        public function __construct()
        
        {
            parent::__construct(
                /*Base ID of your widget*/
                'business_trade_our_service_widget',
                /*Widget name will appear in UI*/
                esc_html__( 'TM: Our Service Widget', 'business-trade' ),
                /*Widget description*/
                array( 'description' => esc_html__( 'TM: Our Service Widget, Best Used in Home page', 'business-trade' ) )
            );
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         *
         * @return void
         *
         */
        public function widget( $args, $instance )
        {

            if (!empty( $instance ) ) 
            {
              $instance    = wp_parse_args( (array ) $instance, $this->defaults ());
              $title       = apply_filters('widget_title', !empty($instance['title']) ? esc_html( $instance['title']): '', $instance, $this->id_base);
              
              $read_more   = esc_html($instance['read_more']);
              
              $no_of_words = absint($instance['no_of_words']);
              
              $features    = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();
               
               if (isset($features) ) : 
                echo $args['before_widget'];
                ?>

                 <!-- Featured Service Slider Start Here -->
                <div class="service-slider-one-area">
                    <div class="container">
                     <?php
                           if(!empty($title))
                           {
                         ?>
                              
                            <div class="section-title">
                                <h2><?php echo $title; ?></h2>
                            </div>

                      <?php } ?>      
                        <div class="fn-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="1" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="3" data-r-medium-nav="true" data-r-medium-dots="false">
                           <?php

                             $post_in = array();

                          if  (count($features) > 0 && is_array($features) )
                          {
                              $post_in[0] = $features['main'];
                                
                              foreach ( $features as $our_services )
                              {
                                    
                                  if( isset( $our_services['page_ids'] ) && !empty( $our_services['page_ids'] ) )
                                  {
                                      
                                     $post_in[] = $our_services['page_ids'];
                                      
                                  }
                              }
                          }
                          
                          if( !empty( $post_in )) :
                              $services_page_args = array(
                                      'post__in'            => $post_in,
                                      'orderby'             => 'post__in',
                                      'posts_per_page'      => count( $post_in ),
                                      'post_type'           => 'page',
                                      'no_found_rows'       => true,
                                      'post_status'         => 'publish'
                              );
                              $services_query = new WP_Query( $services_page_args );

                              /*The Loop*/
                              if ( $services_query->have_posts() ):
                                  $i = 1;
                                  while ( $services_query->have_posts() ):$services_query->the_post();
                                      
                                      ?>

                                      <div class="single-feature-slide">
                                         
                                     <?php  if (has_post_thumbnail()) { 
                                            $image_id   = get_post_thumbnail_id();
                                            $image_url  = wp_get_attachment_image_src($image_id, 'full', true);

                                            $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                           
                                            ?>
                                           
                                            <div class="feature-slide-img"><img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($alt); ?>">
                                            </div>

                                        <?php } ?>    

                                          <div class="feature-slide-content">
                                              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                              <p><?php echo esc_html( wp_trim_words(get_the_content(),$no_of_words,'') ); ?></p>
                                              <a class="button btn-flat" href="<?php the_permalink(); ?>"><?php echo $read_more; ?><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                              <a class="feature-icon" href="#">
                                                  <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                                                  <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                              </a>
                                          </div>
                                      </div>
                                      
                                 <?php
                                      endwhile;
                                  endif;
                                  wp_reset_postdata();
                                endif;
                              
                                  ?>
                         
                        </div>
                    </div>
                </div>
                <!-- Featured Service Slider End Here -->
         
                <?php
                endif;
                echo $args['after_widget'];
            }
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         *
         * @return array
         *
         */
        public function update($new_instance, $old_instance)
        {
            $instance                = $old_instance;
            $instance['main']        = absint($new_instance['main']);
            $instance['title']       = ( isset( $new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
            $instance['read_more']   = sanitize_text_field($new_instance['read_more']);
            $instance['no_of_words'] = absint($new_instance['no_of_words']);
                      
            if (isset($new_instance['features']))
            {
                foreach($new_instance['features'] as $feature)
                {
                  
                  $feature['page_ids'] = absint($feature['page_ids']);
                }
                $instance['features']  = $new_instance['features'];
            }
            
            return $instance;

        }

        public function form($instance)
        {
             $instance    = wp_parse_args( (array ) $instance, $this->defaults() );
             $title       = esc_attr( $instance['title'] );
             $read_more   = esc_attr( $instance['read_more'] );
             $no_of_words =  absint($instance['no_of_words']);
             $features    = ( !empty( $instance['features'] ) ) ? $instance['features'] : array(); 
            ?>
            <span class="tm-business-trade-additional">
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-trade'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>
  
           <hr>

           <p>
                <label for="<?php echo esc_attr($this->get_field_id('read_more')); ?>">
                    <?php esc_html_e('Read More Button Text', 'business-trade'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('read_more') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'read_more') ); ?>" value="<?php echo $read_more; ?>">
            </p>
  
           <hr>

           <p>
                <label for="<?php echo esc_attr($this->get_field_id('no_of_words')); ?>"><?php esc_html_e('Number of Words', 'business-trade'); ?></label><br/>
                <input type="number" name="<?php echo esc_attr( $this->get_field_name('no_of_words') ); ?>" class="widefat"  id="<?php echo esc_attr( $this->get_field_id('no_of_words')); ?>"  value="<?php echo $no_of_words; ?>">
            </p>

             <hr>
            <!--updated code-->
            <label><strong><?php _e( 'Select Pages', 'business-trade' ); ?>:</strong></label>
            <br/>
            <small><?php _e( 'Add Page and Remove.', 'business-trade' ); ?></small>
               
             <?php
                 if  ( count( $features ) >=  1 && is_array( $features ) )
                 {
                
                      $selected = $features['main'];

                  }

                  else
                  {
                    $selected = "";
                  }

                $repeater_id   = $this->get_field_id( 'features' ).'-main';
                $repeater_name = $this->get_field_name( 'features'). '[main]';

                $args = array(
                    'selected'          => $selected,
                    'name'              => $repeater_name,
                    'id'                => $repeater_id,
                    'class'             => 'widefat tm-select',
                    'show_option_none'  => __( 'Select Page', 'business-trade'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
              ?>

               <?php
           
            $counter = 0;
           
            if ( count( $features ) > 0 ) 
            {
                foreach( $features as $feature ) 
                {

                    if ( isset( $feature['page_ids'] ) ) 

                    { ?>
                          <div class="tm-business-trade-sec">

                            <label><?php _e( 'Select Pages', 'business-trade' ); ?>:</label>
          
                              <?php
            
                                $repeater_id     = $this->get_field_id( 'features' ) .'-'. $counter.'-page_ids';
                                $repeater_name   = $this->get_field_name( 'features' ) . '['.$counter.'][page_ids]';

                                $args = array(
                                    'selected'          => $feature['page_ids'],
                                    'name'              => $repeater_name,
                                    'id'                => $repeater_id,
                                    'class'             => 'widefat tm-select',
                                    'show_option_none'  => __( 'Select Page', 'business-trade'),
                                    'option_none_value' => 0 // string
                                );
                                wp_dropdown_pages( $args );
                                ?>

                                <a class="tm-business-trade-remove delete"><?php esc_html_e('Remove Section','business-trade') ?></a>
                          </div>
                      <?php
                      $counter++;
                   }
                }
            }

            ?>

         </span>
         <a class="tm-business-trade-add button" data-id="business_trade_our_service_widget" id="<?php echo $repeater_id; ?>"><?php _e('Add New Section', 'business-trade'); ?></a> 
           
            <?php
        }
    }
}


add_action( 'widgets_init', 'business_trade_our_service_widget' );

function business_trade_our_service_widget() {
    
    register_widget( 'Business_Trade_Our_Services_Widget' );
}