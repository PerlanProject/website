<?php
if (!class_exists( 'Business_Trade_Welcome_Msg_Widget' ) ) {
    
    class Business_Trade_Welcome_Msg_Widget extends WP_Widget
    
    {
        private function defaults()
        {
            $defaults             = array(
                'page_id'         => 0,
                'title'           => esc_html__('About Finance', 'business-trade'),
                'name'            => esc_html__('Robert Rozaio', 'business-trade'),
                'designation'     => esc_html__('CEO, Financeco', 'business-trade'),
                'image'           => '',
            );

            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business-trade-about-finance-widget',
                esc_html__( 'TM: About Finance Widget', 'business-trade' ),
                array( 'description' => esc_html__( 'TM: About Finance Widget,Best Used in Home page or other page', 'business-trade' ) )
            );
        }

        public function widget( $args, $instance )
        {

            if ( !empty( $instance ) ) {
                $instance    = wp_parse_args( (array )$instance, $this->defaults() );
                $page_id     = absint($instance['page_id']);
                $title       = esc_html( $instance['title'] );
                $name        = esc_html( $instance['name'] );
                $designation = wp_kses_post( $instance['designation'] );
                $image       = esc_url($instance['image']);
                echo $args['before_widget'];
                if ( !empty( $page_id ) ) {
                    $business_trade_page_args     = array(
                        'page_id'        => $page_id,
                        'posts_per_page' => 1,
                        'post_type'      => 'page',
                        'no_found_rows'  => true,
                        'post_status'    => 'publish'
                    );

                  $about_finance_query = new WP_Query( $business_trade_page_args );
                    if ($about_finance_query->have_posts()):   ?>
                             
                        <!-- Home About Start Here -->
                        <div class="about-one-area" style="<?php  if(!empty($image)) { ?>background: url(<?php echo $image; ?>);background-position: center;background-attachment: scroll;    background-size: cover;<?php } else { ?> background: #f7efef;  <?php } ?>">
                            <div class="container">
                                <div class="row">
                                    <?php while ($about_finance_query->have_posts()):
                                      $about_finance_query->the_post();
                                       
                                       if (has_post_thumbnail()) { 
                                          $image_id   = get_post_thumbnail_id();
                                          $image_url  = wp_get_attachment_image_src($image_id, 'full', true);

                                          $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                       ?>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <div class="about-image">
                                                <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($alt); ?>">
                                            </div>
                                        </div>

                                       <?php } ?> 
                                    
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                            <div class="about-content-center">
                                                        
                                                <div class="about-content">
                                                    <h2><?php echo $title; ?></h2>
                                                    <?php 
                                                        the_content(); 
                                                        wp_link_pages( array(
                                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),
                                                           'after'  => '</div>',
                                                        ) );

                                                      ?>
                                                    <h3><?php echo  $name  ?></h3>
                                                    <h4><?php echo  $designation  ?></h4>
                                                </div>
                                                       
                                            </div>
                                        </div>

                                <?php endwhile;  wp_reset_postdata(); ?> 

                                </div>
                            </div>
                        </div>
                        <!-- Home About End Here -->
                   <?php endif;          
                    echo $args['after_widget'];
                }
            }
        }

        public function update( $new_instance, $old_instance )
        {
            $instance                    = $old_instance;
            $instance['page_id']         = absint($new_instance['page_id']);
            $instance['title']           = sanitize_text_field( $new_instance['title'] );
            $instance['name']            = sanitize_text_field( $new_instance['name'] );
            $instance['designation']     = wp_kses_post( $new_instance['designation'] );
            $instance['image']           = esc_url_raw($new_instance['image']);

            return $instance;
        }

        public function form( $instance )
        
        {
            $instance    = wp_parse_args((array )$instance, $this->defaults() );
            $page_id     = absint($instance['page_id']);
            $title       = esc_attr( $instance['title'] );
            $name        = esc_attr( $instance['name'] );
            $designation = esc_attr( $instance['designation'] );
            $image       = esc_url( $instance['image'] );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo $title ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('page_id')); ?>"><strong><?php esc_html_e('Select Page', 'business-trade'); ?></strong></label><br/>

                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'         => $page_id,
                    'name'             => esc_attr( $this->get_field_name('page_id') ),
                    'id'               => esc_attr( $this->get_field_id('page_id') ),
                    'class'            => 'widefat',
                    'show_oction_none' => esc_html__( 'Select Page', 'business-trade' ),
                );
                wp_dropdown_pages($args);
                ?>
            </p>
            <hr>
            
           <p>
                <label for="<?php echo esc_attr( $this->get_field_id('name')); ?>"><strong><?php esc_html_e('Name', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('name')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('name')); ?>" value="<?php echo $name ?>">
            </p>
           <hr>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('designation')); ?>"><strong><?php esc_html_e('Designation', 'business-trade'); ?></strong></label>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('designation')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('designation')); ?>" value="<?php echo $designation ?>">
            </p>

            <hr>
            <p>
                <label for="<?php echo $this->get_field_id('image'); ?>">
                    <?php _e( 'Select Image', 'business-trade' ); ?>:
                </label>
                <span class="img-preview-wrap" <?php  if ( empty( $image ) ){ ?> style="display:none;" <?php  } ?>>
                    <img class="widefat" src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( 'Image preview', 'business-trade' ); ?>"  />
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo esc_url( $image ); ?>" />
                <input type="button" id="custom_media_button" value="<?php esc_attr_e( 'Upload Image', 'business-trade' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Image','business-trade'); ?>" data-button="<?php esc_attr_e( 'Select Image','business-trade'); ?>"/>
                <input type="button" id="remove_media_button" value="<?php esc_attr_e( 'Remove Image', 'business-trade' ); ?>" class="button media-image-remove" />
            </p>
            <?php
        }
    }

}

add_action( 'widgets_init', 'business_trade_welcome_msg_widget' );

function business_trade_welcome_msg_widget()
{
    register_widget( 'Business_Trade_Welcome_Msg_Widget' );

}