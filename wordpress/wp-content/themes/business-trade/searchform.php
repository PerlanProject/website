<?php
/**
 * Template for displaying search forms in business-trade
 *
 * @package business-trade
 * @version 1.0.0
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) ); 

$business_trade_placeholder_text     = '';
$business_trade_placeholder_option   = business_trade_get_option( 'business_trade_post_search_placeholder_option');

if ( !empty( $business_trade_placeholder_option) ):
    $business_trade_placeholder_text = 'placeholder="'.esc_attr ( $business_trade_placeholder_option ). '"';
endif; ?>
 
<div class="sidebar-box">
	 <div class="sidebar-search fi-clear">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="<?php echo $unique_id; ?>">
				<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'business-trade' ); ?></span>

		        <input type="search" id="<?php echo $unique_id; ?>" class="search-field search-input" <?php echo $business_trade_placeholder_text ;?> value="<?php echo get_search_query(); ?>" name="s" />
			</label>
			<button type="submit" class="search-submit">
		    	<span class="screen-reader-text">
					<?php echo _x( 'Search', 'submit button', 'business-trade' ); ?>
		        </span>
		        <i class="fa fa-search" aria-hidden="true"></i>
		    </button>
		</form>
   </div>
</div>	
