<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Trade
 */
$readme_text = business_trade_get_option( 'business_trade_read_more_text_blog_archive_option');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	   <div class="single-item">

	   		<div class="item-image">
              <?php the_post_thumbnail('full', array('class' => 'img-responsive') );  ?>
               <div class=" date"> <?php echo esc_html( get_the_date ('M' ) ) ?><span> <?php echo esc_html( get_the_date ('d' ) ); ?></span>
                </div>
            </div>
            <div class="item-container">
	            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	            <?php the_excerpt(); ?>
	            <a class="btn-default-black" href="<?php the_permalink(); ?>"><?php echo esc_html($readme_text) ; ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	        </div>

	   </div>
  	
</article><!-- #post-<?php the_ID(); ?> -->
