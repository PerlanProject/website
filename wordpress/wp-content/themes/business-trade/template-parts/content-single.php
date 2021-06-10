<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Trade
 */
$hide_show_feature_image = business_trade_get_option( 'business_trade_show_feature_image_single_option' );
$hide_show_meta_fields   = business_trade_get_option( 'business_trade_meta_fields_single_option' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail()  &&  $hide_show_feature_image == 0 )  : ?>
		
		<div class="item-img-holder">
	         <?php  the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
	    </div>
    <?php endif; 

    if( $hide_show_meta_fields == 0 )

    {
    
    ?>
        <div class="item-header">
            
            <ul class="item-info">
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo esc_html(get_the_date('d M Y')) ?></li>
                <li><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo  esc_html( ucwords(get_the_author()) ); ?></a></li>
                <?php if( has_category()):?>
                <li><i class="fa fa-folder-o" aria-hidden="true"></i><a href="<?php echo get_category_link(get_the_ID()); ?>"><?php  the_category( ', ' ); ?></a></li>
                <?php endif; ?>
                <li><i class="fa fa-comment-o" aria-hidden="true"></i><a href="<?php get_comments_link() ?>"><?php esc_html_e('Comments:','business-trade')?> <?php comments_number( '0', '1', '% ' ); ?></a></li>
            </ul>
           
        </div>

    <?php } ?>    

        <div class="item-fulltext">

            <?php the_content(); 

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),
                    'after'  => '</div>',
                ) );
                ?>
            
            <div class="item-links fi-clear">

              <?php if(has_tag()): ?>
             
                <span><?php esc_html_e('Tags:','business-trade') ?></span> <?php the_tags(''); ?>
             
              <?php endif; ?>
    
            </div>
        </div>

	
		
</article><!-- #post-<?php the_ID(); ?> -->
