<?php
/**
 * ThemeMiles Header Info Section
 *
 */
$wp_customize->add_section(
    'business_trade_top_header_info_section',
    array(
        'priority'   => 1,
        'capability' => 'edit_theme_options',
        'panel'      => 'business_trade_theme_options',
        'title'      => esc_html__('Top Header Info', 'business-trade'),
    )
);

$wp_customize->add_setting(
    'business_trade_top_header_section',
    array(
        'default'           => $default['business_trade_top_header_section'],
        'sanitize_callback' => 'business_trade_sanitize_select',
    )
);

$hide_show_top_header_option = business_trade_slider_option();
$wp_customize->add_control(
    'business_trade_top_header_section',
    array(
        'type'               => 'radio',
        'label'              => esc_html__('Top Header Info Option', 'business-trade'),
        'description'        => esc_html__('Show/hide Option for Top Header Info Section.', 'business-trade'),
        'section'            => 'business_trade_top_header_info_section',
        'choices'            => $hide_show_top_header_option,
        'priority'           => 5
    )
);

/**
 * Field for Font Awesome Icon
 *
 */
$wp_customize->add_setting(
    'business_trade_top_header_section_phone_number_icon',
    array(
        'default'           => $default['business_trade_top_header_section_phone_number_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'business_trade_top_header_section_phone_number_icon',
    array(
         'type'        => 'text',
         'description' => sprintf( esc_html__( 'Insert Font Awesome Class Name %1$s Font Awesome%2$s, Copy full class from fontawesome e.g("fas fa-map-marker-alt")','business-trade'), '<a href="https://fontawesome.com/v4.7.0/cheatsheet/" target="_blank">','</a>' ),
         
         'section'     => 'business_trade_top_header_info_section',
         'priority'    => 6
    )
);

/**
 * Field for Top Header Phone Number
 *
 */
$wp_customize->add_setting(
    'business_trade_top_header_phone_no',
    array(
        'default'           => $default['business_trade_top_header_phone_no'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'business_trade_top_header_phone_no',
    array(
        'type'       => 'text',
        'label'      => esc_html__('Phone Number', 'business-trade'),
        'section'    => 'business_trade_top_header_info_section',
        'priority'   => 8
    )
);

/**
 * Field for Fonsome Icon
 *
 */
$wp_customize->add_setting(
    'business_trade_address_icon',
    array(
        'default'           => $default['business_trade_address_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'business_trade_address_icon',
    array(
        'type'        => 'text',
        'description' => sprintf( esc_html__( 'Insert Font Awesome Class Name %1$s Font Awesome%2$s,Copy full class from fontawesome e.g("fas fa-map-marker-alt")','business-trade'), '<a href="https://fontawesome.com/v4.7.0/cheatsheet/" target="_blank">','</a>' ),
        'section'     => 'business_trade_top_header_info_section',
        'priority'    => 8
        )
);

/**
 * Field for Top Header  Address
 *
 */
$wp_customize->add_setting(
    'business_trade_top_header_address',
    array(
        'default'           => $default['business_trade_top_header_address'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'business_trade_top_header_address',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Address', 'business-trade'),
        'section'   => 'business_trade_top_header_info_section',
        'priority'  => 8
    )
);


/**
 * Field for Fontasome Icon For time
 *
 */
$wp_customize->add_setting(
    'business_trade_time_icon',
    array(
        'default'           => $default['business_trade_time_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'business_trade_time_icon',
    array(
        'type'        => 'text',
        'description' => sprintf( esc_html__( 'Insert Font Awesome Class Name %1$s Font Awesome%2$s, Copy full class from fontawesome e.g("fas fa-map-marker-alt")','business-trade'), '<a href="https://fontawesome.com/v4.7.0/cheatsheet/" target="_blank">','</a>' ),
        'section'     => 'business_trade_top_header_info_section',
        'priority'    => 8
    )
);

/**
 * Field for Top Header Time
 *
 */
$wp_customize->add_setting(
    'business_trade_top_header_time',
    array(
        'default'           => $default['business_trade_top_header_time'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'business_trade_top_header_time',
    array(
        'type'      => 'text',
        'label'     => esc_html__('Opening Time', 'business-trade'),
        'section'   => 'business_trade_top_header_info_section',
        'priority'  => 8
    )
);



/**
 * Request A Quote
 */
$wp_customize->add_setting(
    'business_trade_post_request_quote_text',
    array(
        'default'           => $default['business_trade_post_request_quote_text'],
        'sanitize_callback' => 'sanitize_text_field',

    )
);

$wp_customize->add_control('business_trade_post_request_quote_text',
    array(
        'label'    => esc_html__('Request A Quote Text', 'business-trade'),
        'section'  => 'business_trade_top_header_info_section',
        'type'     => 'text',
        'priority' => 10
    )
);


/**
 *Request A Quote Link
 */
$wp_customize->add_setting(
    'business_trade_request_quote_link',
    array(
        'default'           => $default['business_trade_request_quote_link'],
        'sanitize_callback' => 'esc_url_raw',

    )
);

$wp_customize->add_control('business_trade_request_quote_link',
    array(
        'label'       => esc_html__('Request A Quote Link', 'business-trade'),
        'description' => sprintf( esc_html__('Note: Please Create Request A Quote Page and insert page link Here', 'business-trade')),
        'section'     => 'business_trade_top_header_info_section',
        'type'        => 'url',
        'priority'    => 10
    )
);

/**
 *   Show/Hide Search Icon
 */
$wp_customize->add_setting(
    'business_trade_header_search_icon',
    array(
        'default'           => $default['business_trade_header_search_icon'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_header_search_icon',
    array(
        'type'               => 'checkbox',
        'label'              => esc_html__('Search Icon', 'business-trade'),
        'description'        => esc_html__('Show/hide Search Icon.', 'business-trade'),
        'section'            => 'business_trade_top_header_info_section',
        'priority'           => 30
    )
);