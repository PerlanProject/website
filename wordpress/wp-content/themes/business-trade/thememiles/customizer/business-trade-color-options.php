<?php
/**
 * Color  Options
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'business_trade_color_options',
    array(
        'priority'       => 50,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__(' Business Trade Color Options', 'business-trade'),
    )
);

/**
 * Basic Color Options Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'business_trade_basic_color_option',
    array(
        'title'    => esc_html__('Basic Color Options', 'business-trade'),
        'panel'    => 'business_trade_color_options',
        'priority' => 3,
    )
);
/*
* Primary Color 
*/
$wp_customize->add_setting(
    'business_trade_primary_color',
    array(
        'default'           => $default['business_trade_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'business_trade_primary_color', array(
    'label'  => esc_html__('Primary Color', 'business-trade'),
    'section'      => 'business_trade_basic_color_option',
    'priority'     => 14,

)));



/* 
* Slider Text Color
*
* @since 1.0.0
*/

$wp_customize->add_setting(
    'business_trade_slider_text_color',
    array(
        'default'           => $default['business_trade_slider_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_trade_slider_text_color', array(
    'label'         => esc_html__('Slider Text Color', 'business-trade'),
    'section'       => 'business_trade_basic_color_option',
    'priority'      => 14,

)));


/**
 * Overlay Color
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'business_trade_overlay_color_option',
    array(
        'title'    => esc_html__('Overlay Color Options', 'business-trade'),
        'panel'    => 'business_trade_color_options',
        'priority' => 3,
    )
);


// Overlay Color Picker control. 
    $wp_customize->add_setting(           
         'lbusiness_trade_separator',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
    );
    $wp_customize->add_control(new Business_Trade_Customize_Section_Separator(
        $wp_customize, 
            'business_trade_separator', 
            array(
                'type'    => 'business_trade_separator',
                'label'   => esc_html__( 'Header Image  Background Color', 'business-trade' ),
                'section' => 'business_trade_overlay_color_option',
                
            )                   
        )
    );


// Overlay Color Picker control. 
     $wp_customize->add_setting(
        'business_trade_overlay_bg_color',
        array(
           'default'           =>  $default['business_trade_overlay_bg_color'],
           'type'              => 'theme_mod',
           'capability'        => 'edit_theme_options',
           'sanitize_callback' => 'business_trade_sanitize_rgba',
        )
    );

    $wp_customize->add_control( 
        new Business_Trade_Color_Control(
         $wp_customize,'business_trade_overlay_bg_color',
            array(
              
                'section' => 'business_trade_overlay_color_option',
               
                
            )
        )
    );





