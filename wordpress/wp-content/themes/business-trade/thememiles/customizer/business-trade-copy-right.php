<?php
/**
 * Copyright Info Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'business_trade_copyright_info_section',
    array(
        'priority'        => 50,
        'capability'      => 'edit_theme_options',
        'theme_supports'  => '',
        'title'           => esc_html__('Footer Option', 'business-trade'),
    )
);

/**
 * Field for Copyright
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'business_trade_copyright',
    array(
        'default'           => $default['business_trade_copyright'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'business_trade_copyright',
    array(
        'type'     => 'text',
        'label'    => esc_html__('Copyright', 'business-trade'),
        'section'  => 'business_trade_copyright_info_section',
        'priority' => 8
    )
);



/**
 * Go to Top
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'business_trade_footer_go_to_top',
    array(
        'default'           => $default['business_trade_footer_go_to_top'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'business_trade_footer_go_to_top',
    array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable/Disable Go to top ', 'business-trade'),
        'description' => esc_html__('Go to top Option for Footer Section', 'business-trade'),
        'section'     => 'business_trade_copyright_info_section',
        'priority'    => 8
    )
);

