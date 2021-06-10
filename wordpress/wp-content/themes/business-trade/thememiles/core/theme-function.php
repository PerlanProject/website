<?php
/**
 * enqueue Script for admin dashboard.
 */

if (!function_exists('business_trade_widgets_backend_enqueue')) :
    function business_trade_widgets_backend_enqueue($hook)
    {
    
        wp_register_script('business-trade-custom-widgets', get_template_directory_uri() . '/assets/js/widgets.js', array('jquery'), true);
        wp_enqueue_media();
        wp_enqueue_script('business-trade-custom-widgets');
        wp_enqueue_style('business-trade-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');
        wp_enqueue_style('business-trade-tm-admin', get_template_directory_uri() . '/assets/css/tm-admin-css.css', array(), '2.0.0');
    }

    add_action('admin_enqueue_scripts', 'business_trade_widgets_backend_enqueue');

endif;


/**
 * Sanitize Multiple Category
 * =====================================
 */

if ( !function_exists('business_trade_sanitize_multiple_category') ) :

function business_trade_sanitize_multiple_category( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

endif;


/**
 * Functions for get_theme_mod()
 *
 * @package Business Trade
 * @subpackage Business Trade
 */

if ( !function_exists( 'business_trade_get_option' ) ) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function business_trade_get_option( $key = '' )
    {
        if (empty( $key ) ) {
            return;
        }
        $business_trade_default_options = business_trade_get_default_theme_options();

        $default      = (isset($business_trade_default_options[$key])) ? $business_trade_default_options[$key] : '';

        $theme_option = get_theme_mod($key, $default);

        return $theme_option;

    }

endif;

/**
 * Display related posts from same category
 *
 * @since Business Trade 1.0.0
 *
 * @param int $post_id
 * @return void
 *
*/
if ( !function_exists('business_trade_related_post') ) :

    function business_trade_related_post( $post_id ) {


        $related_post_hide  = absint(business_trade_get_option( 'business_trade_related_post_show_hide'));
        $related_post_title = esc_html(business_trade_get_option('business_trade_related_post_title'));
        $related_post_image = business_trade_get_option('business_trade_related_hide_featured_image');
        $posts_title        = absint(business_trade_get_option('business_trade_related_posts_title_show'));
        $related_post_meta  = absint(business_trade_get_option('business_trade_related_posts_meta_options'));

        if( 0 == $related_post_hide ){
            return;
        }
        $categories = get_the_category( $post_id );
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $business_trade_cat_post_args = array(
                        'category__in'       => $category_ids,
                        'post__not_in'       => array($post_id),
                        'post_type'          => 'post',
                        'posts_per_page'     => 3,
                        'post_status'        => 'publish',
                        'ignore_sticky_posts'=> true
                    );
              $business_trade_featured_query = new WP_Query( $business_trade_cat_post_args );
                if ($business_trade_featured_query->have_posts() ) :
            ?>
            <div class="latest-news-one-area">
                <div class="section-title"">
                    <h2>
                        <?php echo esc_html($related_post_title); ?>
                    </h2>
                </div>    
                  <div class="latest-news">
                    <?php
                    

                    while ( $business_trade_featured_query->have_posts() ) : $business_trade_featured_query->the_post();
                        ?>
                          <div class="single-new col-lg-4 col-md-4 col-sm-4 col-xs-12">

                                <?php
                            
                                if ( has_post_thumbnail() && $related_post_image ==1 ) {
                                
                                    $image_id = get_post_thumbnail_id();

                                    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                
                                    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
                                ?>
                                    <div class="item-image">
                                        
                                       <a href="<?php the_permalink(); ?>"> <img class="image-responsive" src="<?php echo esc_url($image_url[0]);?>" alt="<?php echo esc_attr($alt); ?>"></a>
                                        
                                    </div>
                             <?php } ?>
                                <div class="item-info">
                                    <?php if( $posts_title == 1) {  ?>
                                    
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                              
                              <?php } ?>
                           
                             <?php
                                if( $related_post_meta == 1)
                                 {
                                ?>
                                    <span class="favourite"><i class="fa ffa fa-calendar-o" aria-hidden="true"></i><?php echo esc_html(get_the_date('d M Y')) ?></span>
                                    <span class="comments"><i class="fa fa-comments-o" aria-hidden="true"></i>
                                        <?php comments_number( '0', '1', '% ' ); ?></span>
                            <?php } ?>        
                                </div>
                            </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div> <!-- .related-post-block -->
        <?php
        endif;
        }
    }
endif;
add_action( 'business_trade_related_post_action', 'business_trade_related_post', 10, 1 );


/**
 * Exclude category in blog page
 *
 * @since Business Trade 1.0.0
 *
 * @param null
 * @return int
 */
if (!function_exists('business_trade_exclude_category_in_blog_page')) :
    function business_trade_exclude_category_in_blog_page($query)
    {

        if ($query->is_home && $query->is_main_query() || $query->is_archive && $query->is_main_query() ) {
            $catid = business_trade_get_option('business_trade_exclude_cat_blog_archive_option');
            $exclude_categories = $catid;
            if (!empty($exclude_categories)) {
                $cats = explode(',', $exclude_categories);
                $cats = array_filter($cats, 'is_numeric');
                $string_exclude = '';
                echo $string_exclude;
                if (!empty($cats)) {
                    $string_exclude = '-' . implode(',-', $cats);
                    $query->set('cat', $string_exclude);
                }
            }
        }
        return $query;
    }
endif;
add_filter('pre_get_posts', 'business_trade_exclude_category_in_blog_page');


/**
 * remove [..] from excerpt
 * =====================================
 */
function business_trade_excerpt_more( $more ) {
    if( !is_admin() ){
     return '';
    }
}
add_filter('excerpt_more', 'business_trade_excerpt_more');


/**
 * Load Breadcrumbs
*/
require get_template_directory() . '/thememiles/library/breadcrumbs/breadcrumbs.php';

/**
 * Load Bradcrumb
*/
require get_template_directory() . '/thememiles/hooks/breadcrumbs.php';


/**
 * Load tgm for this theme
 */
require get_template_directory() . '/thememiles/library/tgm/class-tgm-plugin-activation.php';

/**
 * Plugin recommendation using TGM
*/
require get_template_directory() . '/thememiles/hooks/tgm.php';

/**
 * Load Upgrade to pro
 */
require get_template_directory() . '/thememiles/customizer-pro/class-customize.php';


/**
 * Load Metabox file
 * =====================================
 *
 * /**
 * Metabox for Page Layout Option
 */

require get_template_directory() . '/thememiles/metabox/metabox-defaults.php';


/*
* Including Custom Widget Files
=====================================


/**
 * Custom about-finance-widget
 */
require get_template_directory() . '/thememiles/widget/about-finance-widget.php';


/**
 * Custom Services Widget
 */
require get_template_directory() . '/thememiles/widget/services-widget.php';


/**
 * Custom OUr Services Widget
 */
require get_template_directory() . '/thememiles/widget/our-services-widget.php';


/**
 *  Call-to-action-widget
 */
require get_template_directory() . '/thememiles/widget/call-to-action-widget.php';


/**
 * Custom contact-us-widget
 */
require get_template_directory() . '/thememiles/widget/contact-us-widget.php';



/**
 * Custom Testimonial  Widget
 */
 require get_template_directory() . '/thememiles/widget/testimonial-widget.php';

 /**
 * Custom Recent Widget
 */

require get_template_directory() . '/thememiles/widget/recent-post-widget.php';


/**
 * Custom Faq Widget
*/
require get_template_directory() . '/thememiles/widget/faq-widget.php';

/**
 * Custom Our Social Widget
 */
  require get_template_directory() . '/thememiles/widget/social-widget.php';


/**
 * Custom Quote Widget
*/
require get_template_directory() . '/thememiles/widget/quote-widget.php';


/**
 * Loading Site origin Page buider Panel
 */
require get_template_directory() . '/thememiles/hooks/siteorigin-panels.php';