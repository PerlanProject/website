<?php
/**
 * Template Name: Business Trade Builder Page
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Theme Miles
 * @subpackage Business Trade
 */
get_header();


while ( have_posts() ) : the_post();

    the_content();

     wp_link_pages( array('before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),'after'  => '</div>',
				 ) );

endwhile; // End of the loop.

get_footer();