<?php
/**

 * Class for adding Our Team Section Widget

 * @package ThemeMiles

 * @subpackage ThemeMiles

 * @since 1.0.0

 */

if ( ! class_exists( 'Business_Trade_Faq_Widget' ) ) {

	class Business_Trade_Faq_Widget extends WP_Widget {

		/*defaults values for fields*/

		 private function defaults()

        {

            /*defaults values for fields*/

            $defaults    = array(

				'title'            =>  esc_html__('Asked Any Question','business-trade'),

				'image'            => '',
				
				'background-image' => '',
				
				'features'         =>'',

            );

            return $defaults;

        }
	

		function __construct() {

			parent::__construct(

			/*Base ID of your widget*/

				'business_trade_faq_widget',

				/*Widget name will appear in UI*/

				__( 'TM: Faq Widget', 'business-trade' ),

				/*Widget description*/

				array( 'description' => __( 'TM: Faq Widget,Best Used in Home page or Other Page', 'business-trade' ), )

			);

		}

    /**

		 * Function to Creating widget front-end. This is where the action happens

		 * @access public

		 * @since 1.0

		 * @param array $args widget setting

		 * @param array $instance saved values

		 * @return void

		 */

		public function widget( $args, $instance ) {

		if (!empty( $instance ) ) 

		{

			$instance  = wp_parse_args( (array ) $instance, $this->defaults ());
			
			
			$title    = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			
			$image    = esc_url($instance[ 'image']);
			
			$bgimage  = esc_url($instance[ 'background-image']);
			
			$features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();

             echo $args['before_widget'];
            if (isset($features) ) : 
			?>

			 <!-- Asked Question Area Start Here -->
	        <div class="asked-question-two-area" style="<?php  if(!empty($bgimage)) { ?>background: url(<?php echo $bgimage; ?>);background-position: right bottom;
    background-size: cover;background-repeat: no-repeat;position: relative;<?php } else { ?> background: #f7efef;  <?php } ?>">
	            <div class="asked-question">
	                <div class="container">
	                    <div class="row">
	                    	<?php if(!empty( $image )) { ?>
		                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                            <div class="asked-image">
		                                <img class="img-responsive" src="<?php echo $image; ?>" alt="<?php esc_attr_e('faq','business-trade'); ?>">
		                            </div>
		                        </div>
	                    <?php } ?>
	                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                          
	                            <div class="asked-accordion panel-group" id="accordion">
	                                <h2><?php echo $title; ?></h2>
	                              		
	                              		<?php

							                $post_in = array();

							                if  (count($features) > 0 && is_array($features) ){

							                      $post_in[0] = $features['main'];

							                    foreach ( $features as $faq ){

							                        if( isset( $faq['page_ids'] ) && !empty( $faq['page_ids'] ) ){

							                               $post_in[] = $faq['page_ids'];

							                           }

							                    }

							                }

							                if( !empty( $post_in )) :

							                    $faq_page_args = array(

							                            'post__in'         => $post_in,

							                            'orderby'             => 'post__in',

							                            'posts_per_page'      => count( $post_in ),

							                            'post_type'           => 'page',

							                            'no_found_rows'       => true,

							                            'post_status'         => 'publish'

							                    );

							                    $faq_query = new WP_Query( $faq_page_args );

							                    /*The Loop*/
							                    $i=1;

							                    if ( $faq_query->have_posts() ):

							                        while ( $faq_query->have_posts() ):
							                        	$faq_query->the_post();
							                        	
							                            ?>
	                               
						                                <div class="panel panel-default">
						                                    <div class="panel-heading">
						                                        <h4 class="panel-title">
						                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>"><?php the_title(); ?></a>
						                                            </h4>
						                                    </div>

						                                    <div id="collapse<?php echo $i ?>" class="panel-collapse collapse <?php if($i==1){ echo "in"; } ?>">
						                                        <div class="panel-body">
						                                            <?php the_content(); 
						                                            wp_link_pages( array(
		                                                          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),
		                                                          'after'  => '</div>',
		                                                        ) );
						                                            ?>
						                                        </div>
						                                    </div>
						                                </div>

					                            <?php

					                               $i++;

					                                endwhile;

					                            endif;

					                            wp_reset_postdata();

					                          endif;

					                            ?>
	                              
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- Asked Question Area End Here -->
			<?php
            endif;
			echo $args['after_widget'];

		}

    }

       /**

		 * Function to Updating widget replacing old instances with new

		 * @access public

		 * @since 1.0

		 * @param array $new_instance new arrays value

		 * @param array $old_instance old arrays value

		 * @return array

		 */

		public function update( $new_instance, $old_instance ) {

			$instance                     = $old_instance;
			
			$instance['main']             = absint($new_instance['main']);
			
			$instance['title']            = sanitize_text_field( $new_instance['title'] );
			
			$instance['image']            = esc_url_raw($new_instance['image']);
			
			$instance['background-image'] = esc_url_raw($new_instance['background-image']);

		
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

		/*Widget Backend*/

		public function form( $instance ) {

		    $instance      = wp_parse_args( (array ) $instance, $this->defaults() );

			$title         = esc_attr( $instance['title'] );

			$image         = esc_attr($instance['image']);

			$bgimage       = esc_attr($instance['background-image']);

		    $features      = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); 

			?>

           <span class="tm-business-trade-additional">

            <p>

                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title', 'business-trade' ); ?>:</strong></label>

                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
            </p>

            <hr>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id('Dimage') ); ?>">
                    <strong><?php echo esc_html__('Image', 'business-trade'); ?></strong>
                </label>
                <br/>
                <?php
                    echo '<img class="custom_media_image" src="' . esc_url($instance['image']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                 ?>

                <input type="text" class="widefat custom_media_url " name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo $image; ?>"/>
                <input type="button" class="button button-primary media-image-upload custom_media_button" id="custom_media_button" name="<?php echo esc_attr($this->get_field_name('image')); ?>" value="<?php esc_attr_e('Upload Image', 'business-trade') ?>"/>
                <input type="button" id="remove_media_button" value="<?php esc_attr_e( 'Remove Image', 'business-trade' ); ?>" class="button media-image-remove" />


            </p>

           <hr>

           	 <p>
                <label for="<?php echo esc_attr( $this->get_field_id('background-image') ); ?>">
                    <strong><?php echo esc_html__('Background Image', 'business-trade'); ?></strong>
                </label>
                <br/>
                <?php
                    echo '<img class="custom_media_image" src="' . esc_url($instance['background-image']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                 ?>

                <input type="text" class="widefat custom_media_url " name="<?php echo esc_attr($this->get_field_name('background-image')); ?>" id="<?php echo esc_attr($this->get_field_id('background-image')); ?>" value="<?php echo $bgimage; ?>"/>
                <input type="button" class="button button-primary media-image-upload custom_media_button" id="custom_media_button" name="<?php echo esc_attr($this->get_field_name('background-image')); ?>" value="<?php esc_attr_e('Upload Image', 'business-trade') ?>"/>
                 <input type="button" id="remove_media_button" value="<?php esc_attr_e( 'Remove Image', 'business-trade' ); ?>" class="button media-image-remove" />


            </p>

           <hr>
          
            <!--updated code-->

            <label><strong><?php _e( 'Select Pages', 'business-trade' ); ?>:</strong></label>

            <br/>

            <small><?php _e( 'Add Page and Remove for Team Section', 'business-trade' ); ?></small>

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
   
		    	if ( count( $features ) > 0 ) {

		        	foreach( $features as $feature ) {

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

				                <a class="tm-business-trade-remove delete">

				                	<?php esc_html_e('Remove Section','business-trade') ?>

				                </a>

			              </div>

			              <?php

			              $counter++;

		              }

		        }

		    }

		    ?>

		 </span>

		<a class="tm-business-trade-add button" data-id="business_trade_faq_widget" id="<?php echo $repeater_id; ?>"><?php _e('Add New Section', 'business-trade'); ?></a>   
     
			<?php

		}// end of form section

	}

}

add_action( 'widgets_init', 'business_trade_faq_widget' );

function business_trade_faq_widget()

{
    register_widget( 'Business_Trade_Faq_Widget' );

}