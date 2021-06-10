<?php
/**
 * Class for adding Social Section Widget
 *
 * @package ThemeMiles
 * @subpackage ThemeMiles 
 * @since 1.0.0
 */
if ( ! class_exists( 'Business_Trade_Social_Widget' ) ) {

    class Business_Trade_Social_Widget extends WP_Widget {
        /*defaults values for fields*/

        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
                'title'         => '',
            );
            return $defaults;
        }

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'business_trade_social',
                /*Widget name will appear in UI*/
                __('TM: Social Widget', 'business-trade'),
                /*Widget description*/
                array( 'description' => __( 'TM: Social Widget Best Used in Footer Widget', 'business-trade' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $title = esc_attr( $instance[ 'title' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'business-trade' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
            <label> <?php esc_html_e('You must create a Social Menu and Select the Social from Appearance > Customize > Menus', 'business-trade'); ?> </label>
            </p>
            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance            = $old_instance;
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );

	        return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $init_animate_title = '';
            $instance = wp_parse_args( (array) $instance, $this->defaults());

            /*default values*/
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );

            echo $args['before_widget'];
            ?>
                <div class="section footer-box social-links">
                    <?php
                    if(!empty($title))
                    {
                    ?>
                        <div class="section-title">  
                          <div class="widgettitle <?php echo esc_attr( $init_animate_title ); ?>">
                            <?php
                                if( !empty( $title ) ) {
                                    echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                                }
                            ?>
                          </div>
                        </div>
                        
              <?php } ?>    

                    <div class="social-wdgets-icons">
                        <?php
                        if (has_nav_menu('social-link')) {
                            wp_nav_menu(array('theme_location' => 'social-link', 'menu_class' => 'footer-social'));
                        }
                        ?>
                    </div>
                </div>
            <?php
            echo $args['after_widget'];
        }
    }
}
add_action( 'widgets_init', 'business_trade_social_widget' );
function business_trade_social_widget()
{
    register_widget( 'Business_Trade_Social_Widget' );
}