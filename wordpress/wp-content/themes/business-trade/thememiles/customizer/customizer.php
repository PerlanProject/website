<?php
/**
 * Slider Section
 *
 */
$wp_customize->add_section(
    'business_trade_slider_section',
    array(
        'title'     => esc_html__('Slider Setting Option', 'business-trade'),
        'panel'     => 'business_trade_theme_options',
        'priority'  => 4,
    )
);
/**
 * Homepage Slider Repeater Section
 *
 */
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Page For Slider','business-trade');
foreach ($slider_pages_obj as $page_value) {
    $slider_pages[$page_value->ID] = $page_value->post_title;
}
$wp_customize->add_setting( 
    'business_trade_slider_option', 
    array(
    'sanitize_callback' => 'business_trade_sanitize_slider_data',
    'default'           => $default['business_trade_slider_option']
) );
$wp_customize->add_control(
    new Business_Trade_Repeater_Control(
        $wp_customize,
        'business_trade_slider_option',
        array(
            'label'                      => __('Slider Page Selection Section','business-trade'),
            'description'                => __('Select Page For Slider Having Featured Image. You can drag to reposition the slider items','business-trade'),
            'section'                    => 'business_trade_slider_section',
            'settings'                   => 'business_trade_slider_option',
            'repeater_main_label'        => __('Select Page For Slider ','business-trade'),
            'repeater_add_control_field' => __('Add New Slide','business-trade')
        ),
        array(
            'selectpage'                 => array(
            'type'                       => 'select',
            'label'                      => __( 'Select Page For Slide', 'business-trade' ),
            'options'                    => $slider_pages
            ),
            'button_text'                => array(
            'type'                       => 'text',
            'label'                      => __( 'Button Text', 'business-trade' ),
            ),
            'button_link'                => array(
            'type'                       => 'url',
            'label'                      => __( 'Button Link', 'business-trade' ),
            ),
            
        )
    )
);

/**
 * Homepage Slider Section Show
 *
 */
$wp_customize->add_setting(
    'business_trade_homepage_slider_option',
    array(
        'default'           => $default['business_trade_homepage_slider_option'],
        'sanitize_callback' => 'business_trade_sanitize_select',
    )
);
$hide_show_option = business_trade_slider_option();
$wp_customize->add_control(
    'business_trade_homepage_slider_option',
    array(
        'type'        => 'radio',
        'label'       => esc_html__('Slider Option', 'business-trade'),
        'description' => esc_html__('Show/hide option for homepage Slider Section.', 'business-trade'),
        'section'     => 'business_trade_slider_section',
        'choices'     => $hide_show_option,
        'priority'    => 7
    )
);

/**
 * Homepage Slider Title Enable/Disable
 *
 */
$wp_customize->add_setting(
    'business_trade_homepage_slider_title_option',
    array(
        'default'           => $default['business_trade_homepage_slider_title_option'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'business_trade_homepage_slider_title_option',
    array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Hide Slider Title', 'business-trade'),
        'description' => esc_html__('Checked to hide the Slider Title.', 'business-trade'),
        'section'     => 'business_trade_slider_section',
        'priority'    => 10
    )
);

/**
 * Homepage Slider Tagline Enable/Disable
 *
 */
$wp_customize->add_setting(
    'business_trade_homepage_slider_tagline_option',
    array(
        'default'           => $default['business_trade_homepage_slider_tagline_option'],
        'sanitize_callback' => 'business_trade_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'business_trade_homepage_slider_tagline_option',
    array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Hide Slider Description', 'business-trade'),
        'description' => esc_html__('Checked to hide the slider description.', 'business-trade'),
        'section'     => 'business_trade_slider_section',
        'priority'    => 10
    )
);

