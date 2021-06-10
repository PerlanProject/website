<?php
if (!class_exists( 'Business_Trade_Call_To_Action_Widget' ) ) {
    
    class Business_Trade_Call_To_Action_Widget extends WP_Widget
    
    {
        private function defaults()
        {
            $defaults  = array(
                    
                     'title'           => esc_html__('To help entrepreneurs get their act together
                     before they talk to investors.', 'business-trade'),
                     'description'      => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab','business-trade'),
                     'button_text'     => esc_html__('Contact Us', 'business-trade'),
                     
                     'button_text_url' => '',
                     
                     'image'           => '',
            );

            return $defaults;
        }

        public function __construct() 
        {
            parent::__construct(
                'business-trade-call-to-action-widget',
                esc_html__( 'TM: Call To Action', 'business-trade' ),
                array( 'description' => esc_html__( 'TM: Call To Action Widget, Best Used in Home page or other page', 'business-trade' ) )
            );
        }

        public function widget( $args, $instance )
        {

            if ( !empty( $instance ) ) {
                
                $instance        = wp_parse_args( (array )$instance, $this->defaults() );
                $title           = esc_html( $instance['title'] );
                $description     = wp_kses_post( $instance['description'] );
                $button_text     = esc_html( $instance['button_text'] );
                $button_text_url = esc_url($instance['button_text_url']);
                $image           = esc_url($instance['image']);
                echo $args['before_widget']; ?>

                 <!-- Banner One Start Here -->
                    <div class="banner-one-area" style="background: url(<?php echo $image; ?>);background-position: center;background-attachment: scroll;background-size: cover;padding: 90px 0;position: relative;z-index: 1;" >
                        <div class="container">
                            <div class="banner-content call-to-action">
                                <h2><?php echo $title; ?></h2>
                                <p><?php echo $description; ?></p>
                            </div>
                            <a class="btn-default-black" href="<?php echo $button_text_url; ?>"><?php echo $button_text; ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <!-- Banner One End Here -->
           
                <?php   echo $args['after_widget'];
                }
            }
        

        public function update( $new_instance, $old_instance )
        {
            $instance                    = $old_instance;
            $instance['title']           = sanitize_text_field( $new_instance['title'] );
            $instance['description']     = wp_kses_post($new_instance['description']);
            $instance['button_text']     = sanitize_text_field($new_instance['button_text']);
            $instance['button_text_url'] = esc_url_raw( $new_instance['button_text_url'] );
            $instance['image']           = esc_url_raw($new_instance['image']);

            return $instance;
        }

        public function form( $instance )
        
        {
            $instance        = wp_parse_args((array )$instance, $this->defaults() );
            $title           = esc_attr( $instance['title'] );
            $description     = wp_kses_post( $instance['description']  );
            $button_text     = esc_attr( $instance['button_text'] );
            $button_text_url = esc_url( $instance['button_text_url'] );
            $image           = esc_url( $instance['image'] );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo $title ?>">
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('description' ) ); ?>"><strong><?php esc_html_e('Description', 'business-trade'); ?></strong></label><br/>
                <textarea rows="8" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>" id="<?php echo esc_attr( $this->get_field_id('description' ) ); ?>" class="widefat"><?php echo $description; ?></textarea>

 
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id('button_text')); ?>"><strong><?php esc_html_e('Button Text', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('button_text')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" value="<?php echo $button_text ?>">
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id('button_text_url')); ?>"><strong><?php esc_html_e('Button Text Url', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('button_text_url')); ?>" class="business-trade-cons" id="<?php echo esc_attr($this->get_field_id('button_text_url')); ?>" value="<?php echo $button_text_url ?>">
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

add_action( 'widgets_init', 'business_trade_call_to_action_widget' );

function business_trade_call_to_action_widget()
{
    register_widget( 'Business_Trade_Call_To_Action_Widget' );

}