<?php 
/*-------------------------------------------------------------------------------------------*/
/**
 * Theme Option
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'business_trade_single_page_options',
    array(
        'priority'       => 50,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Single Page & Post Options', 'business-trade'),
    )
);

/**
 * Single Post Options
 *
 */
$wp_customize->add_section(
    'business_trade_single_post_page_section',
    array(
        'title'    => esc_html__('Single Post Options', 'business-trade'),
        'panel'    => 'business_trade_single_page_options',
        'priority' => 7,
    )
);


/**
 * Feature Image Option Single Post
 */
$wp_customize->add_setting(
    'business_trade_show_feature_image_single_option',
    array(
        'default'           => $default['business_trade_show_feature_image_single_option'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_show_feature_image_single_option',
    array(
        'type'     => 'checkbox',
        'label'    => esc_html__('Hide Feature Image', 'business-trade'),
        'section'  => 'business_trade_single_post_page_section',
        'priority' => 5
    )
);

/**
 * Meta Options for Single Post
 */
$wp_customize->add_setting(
    'business_trade_meta_fields_single_option',
    array(
        'default'           => $default['business_trade_meta_fields_single_option'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_meta_fields_single_option',
    array(
        'type'     => 'checkbox',
        'label'    => esc_html__('Hide Meta Fields', 'business-trade'),
        'section'  => 'business_trade_single_post_page_section',
        'priority' => 6
    )
);


/**
 * Single Page Options
 *
 */
$wp_customize->add_section(
    'business_trade_single_page_section',
    array(
        'title'    => esc_html__('Single Page Options', 'business-trade'),
        'panel'    => 'business_trade_single_page_options',
        'priority' => 7,
    )
);


/* ========================
* Related Post Section 
===========================*/
$wp_customize->add_section(
    'business_trade_single_related_post_section',
    array(
        'title'    => esc_html__('Related Post Options', 'business-trade'),
        'panel'    => 'business_trade_single_page_options',
        'priority' => 7,
    )
);

/**
 * Show Hide Related Post In Single Post 
*/
$wp_customize->add_setting(
    'business_trade_related_post_show_hide',
    array(
        'default'           => $default['business_trade_related_post_show_hide'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_related_post_show_hide',
    array(
        'type'     => 'checkbox',
        'label'    => esc_html__('Show Related Post ', 'business-trade'),
        'section'  => 'business_trade_single_related_post_section',
        'priority' => 10
    )
);

/**
 * Related Post Title
*/
$wp_customize->add_setting(
    'business_trade_related_post_title',
    array(
        'default'           => $default['business_trade_related_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'business_trade_related_post_title',
    array(
        'type'     => 'text',
        'label'    => esc_html__('Related Post Title ', 'business-trade'),
        'section'  => 'business_trade_single_related_post_section',
        'priority' => 10
    )
);



/**
 * Hide Featured Image
*/
$wp_customize->add_setting(
    'business_trade_related_hide_featured_image',
    array(
        'default'           => $default['business_trade_related_hide_featured_image'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_related_hide_featured_image',
    array(
        'type'     => 'checkbox',
        'label'    => esc_html__('Show Featured Image ', 'business-trade'),
        'section'  => 'business_trade_single_related_post_section',
        'priority' => 10
    )
);

/**
 * Show Posts Title 
*/
$wp_customize->add_setting(
    'business_trade_related_posts_title_show',
    array(
        'default'           => $default['business_trade_related_posts_title_show'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_related_posts_title_show',
    array(
        'type'     => 'checkbox',
        'label'    => esc_html__('Show Posts Title ', 'business-trade'),
        'section'  => 'business_trade_single_related_post_section',
        'priority' => 10
    )
);

/**
 * Show Meta Options 
*/
$wp_customize->add_setting(
    'business_trade_related_posts_meta_options',
    array(
        'default'           => $default['business_trade_related_posts_meta_options'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'business_trade_related_posts_meta_options',
    array(
        'type'     => 'checkbox',
        'label'    => esc_html__('Show Meta Items', 'business-trade'),
        'section'  => 'business_trade_single_related_post_section',
        'priority' => 10
    )
);