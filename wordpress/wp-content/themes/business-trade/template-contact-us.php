<?php
/**
 * The template for displaying all pages
 * Template Name: Contact Us
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeMiels
 * @subpackage Business Trade
 */
get_header();

$business_trade_address   = business_trade_get_option('business_trade_address');
$business_trade_emaill    = business_trade_get_option('business_trade_email_option');
$business_trade_phone     = business_trade_get_option('business_trade_phone_option');
$business_trade_fax       = business_trade_get_option('business_trade_fax_option');
$business_trade_shortcode = business_trade_get_option('business_trade_contact_shortcode_option');

do_action( 'business_trade_breadcrumb_trail' );

?>


 <!-- Contact Start Here -->
<div class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="contact-info">
                       <?php 
				         	while ( have_posts() ) : the_post();

				        	   the_content();

                                wp_link_pages( array('before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),'after'  => '</div>',
                 ) );

				        	endwhile; // End of the loop.   
				        ?>
                    <ul>
                    	<?php
                    	 if(!empty($business_trade_address))
                    	 {
                    	?>	
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo esc_html($business_trade_address); ?></li>
                     
                       <?php }
                       
                        if(!empty($business_trade_emaill))
                    	 
                    	{
                      
                        ?> 

                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo esc_html($business_trade_emaill); ?></li>

                        <?php }
                       
                        if(!empty($business_trade_phone))
                    	 
                    	{ ?>

                        <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_html($business_trade_phone); ?></li>
                        <?php
                        	
                         }
                       
                       if(!empty($business_trade_fax))
                    	 
                    	{ 
                        ?>
                      
                        <li><i class="fa fa-fax" aria-hidden="true"></i><?php echo esc_html($business_trade_fax); ?></li>
                      
                      <?php } ?>

                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php echo do_shortcode($business_trade_shortcode); ?>
            </div>
        </div>
    </div>
</div>
<!-- Contact End Here -->

<?php get_footer(); ?>