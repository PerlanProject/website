<?php
/**
 * Theme Option
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'business_trade_theme_options',
    array(
        'priority'       => 50,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Business Trade Theme Option', 'business-trade'),
    )
);


/*-------------------------------------------------------------------------------------------*/
/**
 * Hide Static page in Home page
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'business_trade_front_page_option',
    array(
        'title'    => esc_html__('Front Page Options', 'business-trade'),
        'panel'    => 'business_trade_theme_options',
        'priority' => 3,
    )
);

/**
 *   Show/Hide Static page/Posts in Home page
 */
$wp_customize->add_setting(
    'business_trade_front_page_hide_option',
    array(
        'default'           => $default['business_trade_front_page_hide_option'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control('business_trade_front_page_hide_option',
    array(
        'label'    => esc_html__('Hide Blog Posts or Static Page on Front Page', 'business-trade'),
        'section'  => 'business_trade_front_page_option',
        'type'     => 'checkbox',
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/
/**
 * Breadcrumb Options
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'business_trade_breadcrumb_option',
    array(
        'title'    => esc_html__('Breadcrumb Options', 'business-trade'),
        'panel'    => 'business_trade_theme_options',
        'priority' => 2,
    )
);

/*-------------------------------------------------------------------------------------------*/
/**
 * Search Placeholder
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'business_trade_search_option',
    array(
        'title'     => esc_html__('Search', 'business-trade'),
        'panel'     => 'business_trade_theme_options',
        'priority'  => 8,
    )
);

/**
 *Search Placeholder
 */
$wp_customize->add_setting(
    'business_trade_post_search_placeholder_option',
    array(
        'default'           => $default['business_trade_post_search_placeholder_option'],
        'sanitize_callback' => 'sanitize_text_field',

    )
);

$wp_customize->add_control('business_trade_post_search_placeholder_option',
    array(
        'label'    => esc_html__('Search Placeholder', 'business-trade'),
        'section'  => 'business_trade_search_option',
        'type'     => 'text',
        'priority' => 10
    )
);




 /*-------------------------------------------------------------------------------------------*/
    /**
     * Breadcrumb Options
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'business_trade_breadcrumb_option',
        array(
                'title'    => esc_html__('Breadcrumb Options', 'business-trade'),
                'panel'    => 'business_trade_theme_options',
                'priority' => 6,
             )
    );

    /**
     * Breadcrumb Option
     */
    $wp_customize->add_setting(
        'business_trade_breadcrumb_setting_option',
        array(
                'default'           => $default['business_trade_breadcrumb_setting_option'],
                'sanitize_callback' => 'business_trade_sanitize_select',

             )
    );

    
    $hide_show_breadcrumb_option = business_trade_show_breadcrumb_option();
    $wp_customize->add_control('business_trade_breadcrumb_setting_option',
        array(
                 'label'       => esc_html__('Breadcrumb Options', 'business-trade'),
                 'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin','business-trade'), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
                 'section'     => 'business_trade_breadcrumb_option',
                 'choices'     => $hide_show_breadcrumb_option,
                 'type'        => 'select',
                 'priority'    => 10
              )
    );


    /**
     *   Show/Hide Breadcrumb in Home page
     */
    $wp_customize->add_setting(
        'business_trade_hide_breadcrumb_front_page_option',
        array(
                'default' => $default['business_trade_hide_breadcrumb_front_page_option'],
                'sanitize_callback' => 'business_trade_sanitize_checkbox',
             )
    );
    $wp_customize->add_control('business_trade_hide_breadcrumb_front_page_option',
        array(
                'label'    => esc_html__('Show/Hide Breadcrumb in Home page', 'business-trade'),
                'section'  => 'business_trade_breadcrumb_option',
                'type'     => 'checkbox',
                'priority' => 10
             )
    );


    /**
     *   Show/Hide Breadcrumb whole section in Home page
     */
    $wp_customize->add_setting(
        'business_trade_hide_breadcrumb_whole_section_front_page_option',
        array(
                'default' => $default['business_trade_hide_breadcrumb_whole_section_front_page_option'],
                'sanitize_callback' => 'business_trade_sanitize_checkbox',
             )
    );
    $wp_customize->add_control('business_trade_hide_breadcrumb_whole_section_front_page_option',
        array(
                'label' => esc_html__('Hide/Show Whole  Breadcrumb section in Home page', 'business-trade'),
                'section' => 'business_trade_breadcrumb_option',
                'type' => 'checkbox',
                'priority' => 10
             )
    );


    /*-------------------------------------------------------------------------------------------*/
    /**
     * Contact Us
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'business_trade_contact_us_option',
        array(
                'title'    => esc_html__('Contact Us Page Options', 'business-trade'),
                'panel'    => 'business_trade_theme_options',
                'priority' => 12,
              )
    );

    /**
     *Contact Us Business Address
     */
    $wp_customize->add_setting(
        'business_trade_address',
        array(
                'default'           => $default['business_trade_address'],
                'sanitize_callback' => 'sanitize_text_field',

              )
    );

    $wp_customize->add_control('business_trade_address',
        array(
                'label'       => esc_html__('Business Address', 'business-trade'),
                'description' => sprintf( esc_html__( 'Insert Business Address [It will work only on Contact Us Template]','business-trade')),
                'section'     => 'business_trade_contact_us_option',
                'type'        => 'text',
                'priority'    => 10
              )
    );


    /**
     *Contact Eamil Information
     */
    $wp_customize->add_setting(
        'business_trade_email_option',
        array(
                'default'           => $default['business_trade_email_option'],
                'sanitize_callback' => 'sanitize_text_field',

              )
    );

    $wp_customize->add_control('business_trade_email_option',
        array(
                'label'       => esc_html__('Email Address', 'business-trade'),
                'description' => sprintf( esc_html__( 'Insert Email Address.[It will work only on Contact Us Template]','business-trade')),
                'section'     => 'business_trade_contact_us_option',
                'type'        => 'text',
                'priority'    => 10
              )
    );

   
  /**
    *Contact Phone Information
   */
    $wp_customize->add_setting(
        'business_trade_phone_option',
        array(
                'default'           => $default['business_trade_phone_option'],
                'sanitize_callback' => 'sanitize_text_field',

              )
    );

    $wp_customize->add_control('business_trade_phone_option',
        array(
                'label'       => esc_html__('Phone Number', 'business-trade'),
                'description' => sprintf( esc_html__( 'Insert Phone Number.[It will work only on Contact Us Template]','business-trade')),
                'section'     => 'business_trade_contact_us_option',
                'type'        => 'text',
                'priority'    => 10
              )
    );


    /**
    *Contact Fax Information
   */
    $wp_customize->add_setting(
        'business_trade_fax_option',
        array(
                'default'           => $default['business_trade_fax_option'],
                'sanitize_callback' => 'sanitize_text_field',

              )
    );

    $wp_customize->add_control('business_trade_fax_option',
        array(
                'label'       => esc_html__('Fax Number', 'business-trade'),
                'description' => sprintf( esc_html__( 'Insert Fax Number.[It will work only on Contact Us Template]','business-trade')),
                'section'     => 'business_trade_contact_us_option',
                'type'        => 'text',
                'priority'    => 10
              )
    );



    /**
    *Contact Form Shortcode
   */
    $wp_customize->add_setting(
        'business_trade_contact_shortcode_option',
        array(
                'default'           => $default['business_trade_contact_shortcode_option'],
                'sanitize_callback' => 'wp_kses_post',

              )
    );

    $wp_customize->add_control('business_trade_contact_shortcode_option',
        array(
                'label'       => esc_html__(' Shortcode From Contact Form', 'business-trade'),
                'description' => sprintf( esc_html__( 'Note: Please Create Contact Form Using Everest Form Plugin And Paste Shortcode Here.[It will work only on Contact Us Template]','business-trade')),
                'section'     => 'business_trade_contact_us_option',
                'type'        => 'text',
                'priority'    => 10
              )
    );
   
   