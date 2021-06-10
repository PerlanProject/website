<?php
/**
 * Recommended plugins
 *
 * @package Business Theme
 */
if ( ! function_exists( 'business_trade_recommended_plugins' ) ) :
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function business_trade_recommended_plugins() {
		$plugins = array(
			
			
			array(
				'name'     => esc_html__( 'Thememiles Toolset', 'business-trade' ),
				'slug'     => 'thememiles-toolset',
				'required' => false,
			),

   
		);
		tgmpa( $plugins );
	}
endif;
add_action( 'tgmpa_register', 'business_trade_recommended_plugins' );
