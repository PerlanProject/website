<?php
if (!class_exists( 'Business_Trade_Contact_Us_Widget' ) ) {
    
    class Business_Trade_Contact_Us_Widget extends WP_Widget
    
    {
        private function defaults()
        {
    $defaults = array(
                 'title'          => esc_html__('Request a Call Back', 'business-trade'),
                 'short_code'     => '',
                 'image'          => '',
            );

            return $defaults;
        }

        public function __construct() 
        {
            parent::__construct(
                'business-trade-contact-us-widget',
                esc_html__( 'TM: Contact Us', 'business-trade' ),
                array( 'description' => esc_html__( 'TM: Contact Us Widget, Best Used in Home page or other page', 'business-trade' ) )
            );
        }

        public function widget( $args, $instance )
        {

            if ( !empty( $instance ) ) {
                $instance        = wp_parse_args( (array )$instance, $this->defaults() );
                $title           = esc_html( $instance['title'] );
                $short_code      = wp_kses_post( $instance['short_code'] );
                $image           = esc_url($instance['image']);
                echo $args['before_widget']; ?>

                <!-- Request Call back Start Here -->
                    <div class="request-call-one-area"  style="background: #cb011b url(<?php echo $image; ?>);background-position: center;background-size: cover;    background-attachment: scroll;background-repeat: no-repeat;    padding: 120px 0 120px;" >
                        <div class="container">
                            <div class="row">
                                <div class="request-form">
                                    <h2 class="request-title"><?php echo  $title;   ?></h2>
                                    <?php echo do_shortcode($short_code);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Request Call back End Here -->

           
                <?php   echo $args['after_widget'];
                }
            }
        

        public function update( $new_instance, $old_instance )
        {
            $instance                    = $old_instance;
            $instance['title']           = sanitize_text_field( $new_instance['title'] );
            $instance['short_code']      = sanitize_text_field($new_instance['short_code']);
            $instance['image']           = esc_url_raw($new_instance['image']);

            return $instance;
        }

        public function form( $instance )
        
        {
            $instance        = wp_parse_args((array )$instance, $this->defaults() );
            $title           = esc_attr( $instance['title'] );
            $short_code      = esc_attr( $instance['short_code'] );
            $image           = esc_url( $instance['image'] );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo $title ?>">
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id('short_code')); ?>"><strong><?php esc_html_e('Contact Form Shortcode', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('short_code')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('short_code')); ?>" value="<?php echo $short_code ?>">
            </p>

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

add_action( 'widgets_init', 'business_trade_contact_us_widget' );

function business_trade_contact_us_widget()
{
    register_widget( 'Business_Trade_Contact_Us_Widget' );

}