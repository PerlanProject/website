<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business_Trade
 */

get_header();

do_action( 'business_trade_breadcrumb_trail' );

?>
<!-- Latest News Start Here -->
<div class="latest-news-area">
    <div class="container">
        <div class="row">
            <!-- Content Start Here -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 left-block">
            	    <div class="news-details-layout">

						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'single' );

					
							?>
							  <div class="item-comments fi-clear">
                                <?php 

                               
                                /**
                                 * business_trade_related_posts hook
                                 * @since ThemeMiles
                                 *
                                 * @hooked business_trade_related_posts -  10
                                 */
                                do_action( 'business_trade_related_post_action' ,get_the_ID() );

                                ?>


                                
                                <div class="item-comments-form">
                                   
                                   <?php
                                   		// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
                                   ?>
                                   
                                </div>
                            </div>

						<?php
    					endwhile; // End of the loop.
						?>

					</div><!-- news-details-layout -->
		    </div><!--col-lg-9 -->
			 <!-- Sidebar Start here -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 right-block">
                <div class="sidebar right-sidebar">

                	<?php get_sidebar(); ?>
                </div>
            </div>   
        </div>
    </div>
</div>             	

<?php get_footer(); ?>