<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Trade
 */

$description_from   = business_trade_get_option( 'business_trade_blog_excerpt_option');
$description_length = business_trade_get_option( 'business_trade_description_length_option') ;
$readme_text        = business_trade_get_option( 'business_trade_read_more_text_blog_archive_option');
$featured_image     = business_trade_get_option('business_trade_featured_image_blog_page');
$meta_options       = business_trade_get_option('business_trade_meta_options_blog_page');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	   <div class="single-item">
	   
	   	 <?php
	     
	      if( has_post_thumbnail() && 0 == $featured_image ) 
	   
	      { 
	        ?>
	   		
	   		<div class="item-image">
             <a href="<?php the_permalink(); ?>">    <?php  the_post_thumbnail('full', array('class' => 'img-responsive') );  ?></a>

           <?php
               if( $meta_options == 0 ) {
              
              ?>
               
                <div class=" date"> <?php echo esc_html( get_the_date ('M' ) ) ?><span> <?php echo esc_html( get_the_date ('d' ) ); ?></span>
                </div>

             <?php } ?>  

            </div>
       <?php } ?>
            <div class="item-container">
	            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	           
	            <?php  echo "<p>";
			         if( $description_from == 'content' )
			         {
			             echo esc_html( wp_trim_words( get_the_content(),$description_length) );

			             wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-trade' ),
						'after'  => '</div>',
					      ) );
						         }
			         else
			         {
			             echo esc_html( wp_trim_words( get_the_excerpt(),$description_length) );
			         }
			         echo "</p>"; 

			      if( !empty( $readme_text) )
                   {
			      ?>
	          
	            <a class="btn-default-black" href="<?php the_permalink(); ?>"><?php echo esc_html($readme_text) ; ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	         
	         <?php } ?>    
	      
	        </div>

	   </div>
   
  
</article><!-- #post-<?php the_ID(); ?> -->
