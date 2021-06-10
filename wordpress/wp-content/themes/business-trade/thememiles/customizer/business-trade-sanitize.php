<?php
/**
 * Define sanitize functions for customizer fields
 *
 * @package Thememiles
 * @subpackage Thememiles
 * @since 1.0.0
 */

/**
 * Sanitize RGBA color field
 *
 * @since Newie 1.0.0
 *
 * @param $checked
 * @return Boolean
 */
function business_trade_sanitize_rgba( $color ) {
    if ( empty( $color ) || is_array( $color ) )
        return 'rgba(0,0,0,0)';

    // If string does not start with 'rgba', then treat as hex
    // sanitize the hex color and finally convert hex to rgba
    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }

    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}



/**
 * Sanitize number
 *
 * @since Thememiles 1.0.0
 *
 * @param $business_trade_input
 * @param $business_trade_setting
 * @return int || float || numeric value
 */
if ( !function_exists( 'business_trade_sanitize_number' ) ) :
    function business_trade_sanitize_number( $input ) 
   {
        $output = intval($input);
        return $output;
    }

endif;


/**
 * Sanitize number
 *
 * @since ThemeMiles 1.0.0
 *
 * @param $business_trade_input
 * @param $business_trade_setting
 * @return int || float || numeric value
 */
if ( !function_exists( 'business_trade_sanitize_floatnumber' ) ) :
    function business_trade_sanitize_floatnumber( $input ) 
   {
        $output = floatval($input);
        return $output;
    }

endif;


/**
 * Sanitize checkbox field
 *
 * @since ThemeMiles 1.0.0
 *
 * @param $checked
 * @return Boolean
 */
if ( !function_exists('business_trade_sanitize_checkbox') ) :
    function business_trade_sanitize_checkbox( $checked ) 
   
    {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }

endif;


/**
 * Sanitize the page/post
 *
 * @since ThemeMiles 1.0.0
 *
 * @param $page_id
 * @return sanitized output as $input
 */
if ( !function_exists( 'business_trade_sanitize_dropdown_pages' ) ) :
        function business_trade_sanitize_dropdown_pages( $page_id, $setting )
        {
            $page_id = absint($page_id );
            // If $page_id is an ID of a published page, return it; otherwise, return the default.
          return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
        }
endif;

/**
 * Sanitizing the select callback example
 *
 * @since ThemeMiles 1.0.0
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 */
if ( !function_exists('business_trade_sanitize_select') ) :
    function business_trade_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input   = sanitize_text_field( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;
/**
 * Sanitizing the select callback example
 *
 * @since ThemeMiles 1.0.0
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 */
function business_trade_sanitize_slider_data( $input ){
    $input_decoded = json_decode( $input, true );
    if( !empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxes => $box ){
            foreach ( $box as $key => $value ){
                if( $key == 'selectpage '){
                    $input_decoded[$boxes][$key] = absint( $value );
                }
                elseif ( $key == 'button_text' ){
                    $input_decoded[$boxes][$key] = sanitize_text_field( $value );
                }
                elseif ( $key == 'button_link' ){
                    $input_decoded[$boxes][$key] = esc_url_raw( $value );
                }
                elseif ( $key == 'optional_button_text' ){
                    $input_decoded[$boxes][$key] = sanitize_text_field( $value );
                }
                elseif ( $key == 'optional_button_link' ){
                    $input_decoded[$boxes][$key] = esc_url_raw( $value );
                }
                else{
                    $input_decoded[$boxes][$key] = esc_attr( $value );
                }
            }
        }
        return json_encode( $input_decoded );
    }
    return $input;
}

