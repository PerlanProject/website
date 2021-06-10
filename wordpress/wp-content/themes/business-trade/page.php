<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Trade
 */
get_header();

do_action( 'business_trade_breadcrumb_trail' );

?>
<div class="case-layout-detail latest-news-area">
    <div class="container">
        <div class="row">
            <!-- Content Start Here -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 left-block">
                <div class="detail-item">
	    			<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						
					?>
				</div>
		    </div>	
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 right-block">
                <div class="sidebar right-sidebar">
                 <?php   get_sidebar(); ?>

                </div>
            </div>    			

	    </div><!-- #row -->
	</div><!-- container -->  
</div><!-- service-layout-detail -->

<?php get_footer(); ?>