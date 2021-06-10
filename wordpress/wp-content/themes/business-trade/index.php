<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Trade
 */

get_header();

$breadcrumb_hide_whole_section = business_trade_get_option( 'business_trade_hide_breadcrumb_whole_section_front_page_option');  

if($breadcrumb_hide_whole_section == 0)
{
	do_action( 'business_trade_breadcrumb_trail' );
}

?>
<!-- Latest News Start Here -->
<div class="latest-news-area" id="content">
    <div class="container">
        <div class="row">
            <!-- Content Start Here -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 left-block">
            	<div class="news-layout-1">

						<?php if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_type() );

							endwhile; ?>

					<div class="pagination-wrapper">
                        
                      	<ul class="pagination">
							<?php the_posts_pagination( array(
							    'mid_size'  => 2,
							    'prev_text' => __( '&laquo;', 'business-trade' ),
							    'next_text' => __( '&raquo;', 'business-trade' ),
							) ); ?>
						</ul>
					
                    </div>
					
					<?php

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
					 
				</div>
            </div>	

            <!-- Sidebar Start here -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 right-block">
                <div class="sidebar right-sidebar">

               <?php get_sidebar(); ?>
                
                </div>
            </div>     	

		</div>
	</div>
</div>	

<?php get_footer();