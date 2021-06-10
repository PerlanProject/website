<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Trade
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
	
		<div class="item-image">
	         <?php  the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
	    </div>
    <?php endif; ?>
   
    <div class="item-content">
     
        <?php
             the_content(); 
        	
        	wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),
			'after'  => '</div>',
		) );
        ?>
    </div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'business-trade' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
