<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Trade
 */
$copyright           = business_trade_get_option('business_trade_copyright');
$enable_go_to_top    = business_trade_get_option('business_trade_footer_go_to_top');
?>
<footer>
    <?php

     if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) {
        $count = 0;
        for ( $i = 1; $i <= 4; $i++ )
        {
            if ( is_active_sidebar( 'footer-' . $i ) )
            {
                $count++;
            }
        }
       
        $column = 3;
       
        if( $count == 4 ) 
        {
            $column = 3;  
        }
        elseif( $count == 3)
        {
            $column = 4;
        }
        elseif( $count == 2) 
        {
            $column = 6;
        }
        elseif( $count == 1) 
        {
            $column = 12;
        }
    
     ?>

        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <?php
                        for ( $i = 1; $i <= 4 ; $i++ )
                        {
                            if ( is_active_sidebar( 'footer-' . $i ) )
                            {
                                ?>

                                <div class="col-lg-<?php echo esc_attr($column) ?> col-md-<?php echo esc_attr($column) ?> col-sm-<?php echo esc_attr($column) ?> col-xs-12">
                                <?php dynamic_sidebar( 'footer-' . $i ); ?>
                                </div>
                   <?php    }
                        }       
                    ?>          
                   
                </div>
            </div>
        </div>

<?php }

if(!empty($copyright) )
{
 ?>

    <div class="copyright">
        <div class="container">
            <p><?php echo wp_kses_post( $copyright ); ?></p>

            <div class="site-info">
				  <a href="<?php echo esc_url( __( 'https://www.wordpress.org/', 'business-trade' ) ); ?>">  <?php printf( esc_html__( ' Proudly powered by %s ', 'business-trade' ), 'WordPress ' ); ?>
                                </a>
                                <span class="sep"> <?php esc_html_e('|','business-trade') ?>  </span>

                <?php printf( esc_html__( ' Theme: %1$s by %2$s.', 'business-trade' ), 'Business Trade', '<a href="https://www.thememiles.com/" target="_blank">ThemeMiles</a>' ); ?>
			</div><!-- .site-info -->

        </div>
    </div>
<?php } ?>
</footer>
<!-- Footer Area End Here -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
