<?php
/**
 * Class for adding Recent Post Widget
 *
 * @package ThemeMiles
 * @subpackage ThemeMiles
 * @since 1.0.0
 */
if (!class_exists('Business_Trade_Recent_Post_Widget')) {
 
    class Business_Trade_Recent_Post_Widget extends WP_Widget
 
    {
        /*defaults values for fields*/
        private function defaults() 
        {
            $defaults       = array(
                'cat_id'       => -1,
                'title'        => esc_html__('Our Latest News','business-trade'),
                'meta_options' => 0,
                'post_number'  => 3, 
            );

            return $defaults;
        }

     public function __construct()
        {
            parent::__construct(
                /* Widget Unique ID */
                'business-trade-recent-post-widget',
                 /* Widget Name */
                esc_html__( 'TM: Blog Widget', 'business-trade' ),
                 /* Widget description */
                array( 'description' => esc_html__( 'TM: Our Blog Widget Best Used in Home page', 'business-trade' ) )
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

            if ( !empty( $instance ) ) {
                
                $instance = wp_parse_args( (array ) $instance, $this->defaults() );
                
                echo $args['before_widget'];
                $catid        = absint( $instance['cat_id'] );
                $title        = apply_filters('widget_title', !empty($instance['title']) ? esc_html( $instance['title']): '', $instance, $this->id_base);
                $meta_options = esc_attr( $instance['meta_options'] );
                $post_number  = absint( $instance['post_number'] );
                
                ?>
                
               
                 <!-- Our Latest News Start Here -->
                <div class="latest-news-one-area bg-accent">
                    <div class="container">
                        <?php
                          if(!empty( $title  )){ ?>
                    
                            <div class="section-title">
                                <h2><?php echo  $title; ?></h2>
                            </div>
                      
                        <?php } ?>
                       
                        <div class="row">
                            <div class="fn-carousel nav-control-middle" data-loop="true" data-items="3" data-margin="0" data-autoplay="false" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="3" data-r-medium-nav="true" data-r-medium-dots="false">
                                
                                 <?php
                                   
                                    $sticky = get_option( 'sticky_posts' );
                                    if ($catid != -1) {
                                        $home_recent_post_section = array(
                                            'ignore_sticky_posts' => true,
                                            'post__not_in'        => $sticky,
                                            'cat'                 => $catid,
                                            'posts_per_page'      => $post_number,
                                            'order'               => 'DESC'
                                        );
                                    } else {
                                        $home_recent_post_section = array(
                                            'ignore_sticky_posts' => true,
                                            'post__not_in'        => $sticky,
                                            'post_type'           => 'post',
                                            'posts_per_page'      => $post_number,
                                            'order'               => 'DESC'
                                        );
                                    }

                                    $home_recent_post_section_query = new WP_Query($home_recent_post_section);

                                    if ( $home_recent_post_section_query->have_posts() ) {
                                        
                                        while ($home_recent_post_section_query->have_posts()) {
                                            
                                            $home_recent_post_section_query->the_post();
                                            
                                     ?> 

                                                <div class="single-news">

                                                    <?php
                                                
                                                    if (has_post_thumbnail()) {
                                                    
                                                        $image_id = get_post_thumbnail_id();
                                                    
                                                        $image_url = wp_get_attachment_image_src($image_id, 'full', true);
                                                        $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                                    ?>
                                                        <div class="item-image">
                                                            
                                                            <img class="image-responsive" src="<?php echo esc_url($image_url[0]);?>" alt="<?php echo esc_attr($alt); ?>">
                                                            
                                                        </div>
                                                 <?php } ?>
                                                    <div class="item-info">
                                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                       
                                                 <?php
                                                    if( $meta_options == 1)
                                                    {
                                                    ?>
                                                        <span class="favourite"><i class="fa ffa fa-calendar-o" aria-hidden="true"></i><?php esc_html_e('Date:','business-trade')?> <?php echo get_the_date('d M Y') ?></span>
                                                        <span class="comments"><i class="fa fa-comments-o" aria-hidden="true"></i><?php esc_html_e('Comments:','business-trade')?> <?php comments_number( '0', '1', '% ' ); ?></span>
                                                <?php } ?>        
                                                    </div>
                                                </div>

                                     <?php
                                    
                                    }
                                }
                                wp_reset_postdata();
                                ?>   

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Our Latest News End Here -->
                   
                <?php
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
            $instance                 = $old_instance;
            $instance['cat_id']       = (isset( $new_instance['cat_id'] ) ) ? absint($new_instance['cat_id']) : '';
            $instance['title']        = sanitize_text_field( $new_instance['title'] );
            $instance['post_number']  = (isset( $new_instance['post_number'] ) ) ? absint($new_instance['post_number']) : '';
            $instance['meta_options'] = isset($new_instance['meta_options'])? 1 : 0;

            return $instance;

        }
        /*Widget Backend*/
        public function form( $instance )
        {
            $instance     = wp_parse_args( (array ) $instance, $this->defaults() );
            $catid        = esc_attr( $instance['cat_id'] );
            $title        = esc_attr( $instance['title'] );
            $post_number  = esc_attr( $instance['post_number'] );
            $meta_options = esc_attr( $instance['meta_options'] );

            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-trade'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>

           <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>">
                    <?php esc_html_e('Select Category', 'business-trade'); ?>
                </label><br/>
                <?php
                $business_trade_con_dropown_cat = array(
                    'show_option_none' => esc_html__('From Blog Posts', 'business-trade'),
                    'orderby'          => 'name',
                    'order'            => 'asc',
                    'show_count'       => 1,
                    'hide_empty'       => 1,
                    'echo'             => 1,
                    'selected'         => $catid,
                    'hierarchical'     => 1,
                    'name'             => esc_attr( $this->get_field_name('cat_id') ),
                    'id'               => esc_attr( $this->get_field_name('cat_id') ),
                    'class'            => 'widefat',
                    'taxonomy'         => 'category',
                    'hide_if_empty'    => false,
                );

                wp_dropdown_categories( $business_trade_con_dropown_cat );
                
                ?>
            </p>
           
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id('post_number') ); ?>">
                    <?php esc_html_e( 'Number of Post ', 'business-trade'); ?>
                </label><br/>
                <input type="number" name="<?php echo esc_attr($this->get_field_name('post_number')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>" value="<?php echo $post_number; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('meta_options')); ?>">
                        <?php esc_html_e('Show/Hide Meta Tags', 'business-trade'); ?>
                </label>
                <input class="widefat" id="<?php echo  esc_attr( $this->get_field_id( 'meta_options' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'meta_options' ) ); ?>" type="checkbox" value="<?php echo esc_attr( $meta_options ); ?>" <?php checked( 1, esc_attr( $meta_options ), 1 ); ?>/>
            </p>

            <?php
        }
    }
}

add_action('widgets_init', 'business_trade_recent_post_widget');

function business_trade_recent_post_widget()

{
    register_widget('Business_Trade_Recent_Post_Widget');

}