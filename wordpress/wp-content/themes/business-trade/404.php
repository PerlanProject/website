<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Business_Trade
 */

get_header();

do_action( 'business_trade_breadcrumb_trail' );

?>

<!-- Inner Title banner End Here -->
<!-- 404 Error Start Here -->
<div class="error-area">
    <div class="container">
        <div class="error-top-wrapper">
            <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri() )?>/assets/images/404.png" alt="<?php  esc_attr_e('404','business-trade') ?>">
        </div>
        <div class="error-bottom-wrapper">
            <h2><?php esc_html_e( 'Sorry Page Was Not Found', 'business-trade' ); ?></h2>
            <p><?php esc_html_e( 'The page you are looking is not available or has been removed. Try going to Home Page by using the button below.', 'business-trade' ); ?></p>
            <a href="<?php echo esc_url(home_url()); ?>" class="error-btn"><?php esc_html_e( 'Go To Home', 'business-trade' ); ?></a>
        </div>
    </div>
</div>
<!-- 404 Error End Here -->
	
<?php
get_footer();
