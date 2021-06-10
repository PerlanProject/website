<?php
if (!class_exists('Business_Trade_Quote_Widget'))
{
    class Business_Trade_Quote_Widget extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
				'title'            => esc_html__('Waste No More Time!','business-trade'),
				'description'      => esc_html__('Rimply dummy text of the printing and typesetting industry Ipsum has been the industry','business-trade'),
				'button-text'      => esc_html__('Get a Quote ','business-trade'),
				'button-text-link' => '#',
            );
            return $defaults;
        }
        public function __construct()
        {
            parent::__construct(
                'business-trade-quote-widget',
                esc_html__('TM: Quote Widget', 'business-trade'),
                array('description' => esc_html__('TM: Quote Section', 'business-trade'))
            );
        }

        public function widget($args, $instance)
        {

            if (!empty($instance))
            {
				$instance         = wp_parse_args( (array ) $instance, $this->defaults() );
				$title            = apply_filters( 'widget_title', !empty( $instance['title'] ) ? esc_html( $instance['title'] ) : '', $instance, $this->id_base);
				$description      = wp_kses_post( $instance['description'] );
				$button_text      = esc_html( $instance['button-text'] );
				$button_text_link = esc_url( $instance['button-text-link'] );
               
                echo $args['before_widget'];
              
                ?>

                 <!-- Waste More time Start Here -->
		        <div class="waste-time-area">
		            <div class="container">
		                <div class="row">
		                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		                        <div class="waste-time-content">
		                            <h3><?php echo $title; ?></h3>
		                            <p><?php echo $description; ?></p>
		                        </div>
		                    </div>
		                    <?php
                            if(!empty($button_text))
                            {
                                ?>
			                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			                        <div class="waste-time-button">
			                            <a href="<?php echo $button_text_link; ?>" class="btn btn-default btn-rounded"><?php echo $button_text; ?> <i class="fa fa-angle-right"></i></a>
			                        </div>
			                    </div>
		                   <?php } ?> 

		                </div>
		            </div>
		        </div>
		        <!-- Waste More time End Here -->

                <?php
                echo $args['after_widget'];
            }
        }

        public function update($new_instance, $old_instance)
        {
				$instance                     = $old_instance;
				$instance['title']            = sanitize_text_field($new_instance['title']);
				$instance['description']      = wp_kses_post($new_instance['description']);
				$instance['button-text']      = sanitize_text_field( $new_instance['button-text']);
				$instance['button-text-link'] = esc_url_raw( $new_instance['button-text-link']);
				return $instance;
        }

        public function form($instance)
        {
			$instance         = wp_parse_args( (array ) $instance, $this->defaults() );
			$title            = esc_attr( $instance['title']  );
			$description      = wp_kses_post( $instance['description']  );
			$button_text      = esc_attr( $instance['button-text'] );
			$button_text_link = esc_url( $instance['button-text-link'] );

            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title')); ?>">
                    <strong><?php esc_html_e('Title', 'business-trade'); ?>
                </strong>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>" value="<?php echo $title?>">
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id('description' ) ); ?>"><strong><?php esc_html_e('Description', 'business-trade'); ?></strong></label><br/>
                <textarea rows="8" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>" id="<?php echo esc_attr( $this->get_field_id('description' ) ); ?>" class="widefat"><?php echo $description; ?></textarea>

 
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text' ) ); ?>"><strong><?php esc_html_e('Button Text', 'business-trade'); ?></strong></label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button-text' ) ); ?>" value="<?php echo $button_text; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text-link' ) ); ?>"><strong>
                    <?php esc_html_e('Button Link', 'business-trade'); ?>
                </strong></label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('button-text-link')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button-text-link' ) ); ?>" value="<?php echo $button_text_link; ?>">
            </p>
            <?php
        }
    }
}
add_action('widgets_init', 'business_trade_quote_widget');
function business_trade_quote_widget()
{
    register_widget('Business_Trade_Quote_Widget');

}















