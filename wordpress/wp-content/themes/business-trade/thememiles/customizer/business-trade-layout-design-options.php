<?php

/*-------------------------------------------------------------------------------------------*/
/**
 * Sidebar Option
 *
 */
$wp_customize->add_section(
    'business_trade_default_sidebar_layout_option',
    array(
        'title'    => esc_html__('Default Sidebar Layout Option', 'business-trade'),
        'panel'    => 'business_trade_theme_options',
        'priority' => 5,
    )
);

/**
 * Sidebar Option
 */
$wp_customize->add_setting(
    'business_trade_sidebar_layout_option',
    array(
        'default'           => $default['business_trade_sidebar_layout_option'],
        'sanitize_callback' => 'business_trade_sanitize_select',
    )
);


$layout = business_trade_sidebar_layout();
$wp_customize->add_control('business_trade_sidebar_layout_option',
    array(
        'label'       => esc_html__('Default Sidebar Layout', 'business-trade'),
        'description' => esc_html__('Home/front page does not have sidebar. Inner pages like blog, archive single page/post Sidebar Layout. However single page/post sidebar can be overridden.', 'business-trade'),
        'section'     => 'business_trade_default_sidebar_layout_option',
        'type'        => 'select',
        'choices'     => $layout,
        'priority'    => 10
    )
);


/*-------------------------------------------------------------------------------------------*/

/**
 * Blog/Archive Layout Option
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'business_trade_blog_archive_layout_option',
    array(
        'title'    => esc_html__('Blog/Archive Layout Option', 'business-trade'),
        'panel'    => 'business_trade_theme_options',
        'priority' => 6,
    )
);

/**
 * Blog Page Title
 */
$wp_customize->add_setting(
    'business_trade_blog_title_option',
    array(
        'default'           => $default['business_trade_blog_title_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('business_trade_blog_title_option',
    array(
        'label'    => esc_html__('Blog Page Title', 'business-trade'),
        'section'  => 'business_trade_blog_archive_layout_option',
        'type'     => 'text',
        'priority' => 11
    )
);

/**
 * Blog/Archive excerpt option
 */
$wp_customize->add_setting(
    'business_trade_blog_excerpt_option',
    array(
        'default'           => $default['business_trade_blog_excerpt_option'],
        'sanitize_callback' => 'business_trade_sanitize_select',
    )
);
$blogexcerpt = business_trade_blog_excerpt();
$wp_customize->add_control('business_trade_blog_excerpt_option',
    array(
        'choices'   => $blogexcerpt,
        'label'     => esc_html__('Show Description From', 'business-trade'),
        'section'   => 'business_trade_blog_archive_layout_option',
        'type'      => 'select',
        'priority'  => 8
    )
);

/**
 * Description Length In Words
 */
$wp_customize->add_setting(
    'business_trade_description_length_option',
    array(
        'default'           => $default['business_trade_description_length_option'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('business_trade_description_length_option',
    array(
        'label'    => esc_html__('Description Length In Words', 'business-trade'),
        'section'  => 'business_trade_blog_archive_layout_option',
        'type'     => 'number',
        'priority' => 12
    )
);

/**
 * Exclude Categories In Blog/Archive Pages
 */
$wp_customize->add_setting(
    'business_trade_exclude_cat_blog_archive_option',
    array(
        'default'           => $default['business_trade_exclude_cat_blog_archive_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('business_trade_exclude_cat_blog_archive_option',
    array(
        'label'        => esc_html__('Exclude Categories In Blog Page', 'business-trade'),
        'description'  => esc_html__('Enter categories ids with comma separated eg: 2,7,14,47. For including all categories left blank', 'business-trade'),
        'section'      => 'business_trade_blog_archive_layout_option',
        'type'         => 'text',
        'priority'     => 13
    )
);


/**
 * Read More Text
 */
$wp_customize->add_setting(
    'business_trade_read_more_text_blog_archive_option',
    array(
        'default'           => $default['business_trade_read_more_text_blog_archive_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('business_trade_read_more_text_blog_archive_option',
    array(
        'label'    => esc_html__('Read More Text', 'business-trade'),
        'section'  => 'business_trade_blog_archive_layout_option',
        'type'     => 'text',
        'priority' => 14
    )
);

/**
 * Featured Image
 */
$wp_customize->add_setting(
    'business_trade_featured_image_blog_page',
    array(
        'default'           => $default['business_trade_featured_image_blog_page'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_trade_featured_image_blog_page',
    array(
        'label'    => esc_html__('Hide/Show Featured Image in Blog Page', 'business-trade'),
        'section'  => 'business_trade_blog_archive_layout_option',
        'type'     => 'checkbox',
        'priority' => 14
    )
);

/**
 * Hide Meta 
 */
$wp_customize->add_setting(
    'business_trade_meta_options_blog_page',
    array(
        'default'           => $default['business_trade_meta_options_blog_page'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_trade_meta_options_blog_page',
    array(
        'label'    => esc_html__('Hide/Show Meta Fields', 'business-trade'),
        'section'  => 'business_trade_blog_archive_layout_option',
        'type'     => 'checkbox',
        'priority' => 14
    )
);

