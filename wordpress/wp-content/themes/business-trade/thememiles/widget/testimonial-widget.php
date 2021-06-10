<?php
/**
* Class for adding Our Testimonials Section Widget
*
* @package ThemeMiles
* @subpackage ThemeMiles
* @since 1.0.0
*/
if ( !class_exists( 'Business_Trade_Testimonial_Widget' ) ) 
{
    class Business_Trade_Testimonial_Widget extends WP_Widget

    {

        private function defaults()
        /* Default Value */
        {
            $defaults = array(
            'title'    => esc_html__('Testimonials','business-trade'),
            'bg_image' => '',
            'features' =>'',
            );
            return $defaults;
        }

    public function __construct()

        {
            parent::__construct(
            /*Widget ID */
            'business_trade_testimonial_widget',
            /*Widget Name */
            esc_html__( 'TM: Testimonial Widget', 'business-trade' ),
            /*Widget description */
            array('description' => esc_html__( 'TM: Testimonial Widget, Best Used in Home page or other page', 'business-trade' ) )
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
  
        public function widget($args, $instance)
        {
            if (!empty($instance)) 
            {
                $instance  = wp_parse_args((array )$instance, $this->defaults());

                $title     = apply_filters('widget_title', !empty($instance['title']) ? esc_html( $instance['title']): '', $instance, $this->id_base);
              
                $bg_image  = esc_url($instance['bg_image']);

                $features  = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();

                echo $args['before_widget'];

             if (isset($features) && !empty($features['main'])) : ?>    

                  <!-- Testimonial Start Here -->
                <div class="testimonial-two-area overlay-dark" style="background-image: url(<?php echo $bg_image; ?>);">
                    <div class="container">
                        <div class="fn-carousel arrow-left-right" data-loop="true" data-items="1" data-margin="0" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="1" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="1" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="1" data-r-medium-nav="true" data-r-medium-dots="false">
                            
                    <?php
                        $post_in = array();

                        if  (count($features) > 0 && is_array($features) )
                        {


                            $post_in[0] = $features['main'];

                            foreach ( $features as $our_testimonial )
                            {

                                if( isset( $our_testimonial['page_ids'] ) && !empty( $our_testimonial['page_ids'] ) )
                                {

                                  $post_in[] = $our_testimonial['page_ids'];

                                }
                            }


                        }

                        if( !empty( $post_in )) :
                        $testimonials_page_args = array(
                        'post__in'            => $post_in,
                        'orderby'             => 'post__in',
                        'posts_per_page'      => count( $post_in ),
                        'post_type'           => 'page',
                        'no_found_rows'       => true,
                        'post_status'         => 'publish'
                        );
                        $testimonials_query = new WP_Query( $testimonials_page_args );
                        /*The Loop*/
                        if ( $testimonials_query->have_posts() ):

                            while ( $testimonials_query->have_posts() ):$testimonials_query->the_post(); 

                                 ?>

                                    <div class="single-testimonial">
                                        <div class="testimo-info">
                                            
                                            <?php

                                                if (has_post_thumbnail()) {

                                                    $image_id = get_post_thumbnail_id();

                                                    $image_url = wp_get_attachment_image_src($image_id, 'full', true);

                                                    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

                                                    ?>
                                                     <div class="testimo-img"><img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($alt); ?>"></div>

                                               <?php } ?> 


                                            <ul class="rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                            <div class="testimo-title">
                                                <h3><?php the_title(); ?>
                                                
                                            </div>
                                        </div>
                                        <div class="testimo-content">
                                           <?php the_content(); ?>
                                        </div>
                                    </div>
                           
                            <?php endwhile;endif; wp_reset_postdata();endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Testimonial End Here -->

            
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

    public function update( $new_instance, $old_instance )
    {
          $instance             = $old_instance;
          
          $instance['main']     = absint($new_instance['main']);
          
          $instance['title']    = ( isset( $new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
          
          $instance['bg_image'] = esc_url_raw($new_instance['bg_image']);

    if (isset($new_instance['features']))

    {
        foreach($new_instance['features'] as $feature)
        {

         $feature['page_ids'] = absint($feature['page_ids']);
        
        }

         $instance['features'] = $new_instance['features'];
    }

    return $instance;

    }

    public function form( $instance )
    {
        $instance  = wp_parse_args( (array )$instance, $this->defaults() );
        $title     = esc_attr( $instance['title'] );
        $bgimage   = esc_url( $instance['bg_image'] );
        $features  = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); 

        ?>
           <span class="tm-business-trade-additional">

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-trade'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>
            <hr>
            
            <label><strong><?php _e( 'Select Pages', 'business-trade' ); ?>:</strong></label>
            <br/>
            <em><?php _e( 'Select Page and Remove. Please do not forget to add Featured Image and Excerct on selected pages.', 'business-trade' ); ?></em> <br/>
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
            'class'             => 'widefat ct-select',
            'show_oction_none'  => __( 'Select Page', 'business-trade'),
            'oction_none_value' => 0 // string
            );
            wp_dropdown_pages( $args );
           
            $counter = 0;
            if ( count( $features ) > 0 ) 
            {
                foreach( $features as $feature ) 
                {

                    if ( isset( $feature['page_ids'] ) ) 
                        { ?>
                            <div class="tm-business-trade-sec">
                                <?php
                                $repeater_id     = $this->get_field_id( 'features' ) .'-'. $counter.'-page_ids';
                                $repeater_name   = $this->get_field_name( 'features' ) . '['.$counter.'][page_ids]';
                                $args = array(
                                'selected'          => $feature['page_ids'],
                                'name'              => $repeater_name,
                                'id'                => $repeater_id,
                                'class'             => 'widefat ct-select',
                                'show_oction_none'  => __( 'Select Page', 'business-trade'),
                                'oction_none_value' => 0 // string
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
        <a class="tm-business-trade-add button" data-id="business_trade_testimonial_widget" id="<?php echo $repeater_id; ?>"><?php _e('Add New Section', 'business-trade'); ?></a> 
        <hr>
        <p>
                <label for="<?php echo $this->get_field_id('bg_image'); ?>">
                    <?php _e( 'Select Background Image', 'business-trade' ); ?>:
                </label>
                <span class="img-preview-wrap" <?php  if ( empty( $bgimage ) ){ ?> style="display:none;" <?php  } ?>>
                    <img class="widefat" src="<?php echo esc_url( $bgimage ); ?>" alt="<?php esc_attr_e( 'Image preview', 'business-trade' ); ?>"  />
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('bg_image'); ?>" id="<?php echo $this->get_field_id('bg_image'); ?>" value="<?php echo esc_url( $bgimage ); ?>" />
                <input type="button" id="custom_media_button" value="<?php esc_attr_e( 'Upload Image', 'business-trade' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Background Image','business-trade'); ?>" data-button="<?php esc_attr_e( 'Select Background Image','business-trade'); ?>"/>
                <input type="button" id="remove_media_button" value="<?php esc_attr_e( 'Remove Image', 'business-trade' ); ?>" class="button media-image-remove" />
        </p>

        <?php
        }
        }

}

add_action( 'widgets_init', 'business_trade_testimonial_widget' );

function business_trade_testimonial_widget()
{
  register_widget( 'Business_Trade_Testimonial_Widget' );
}