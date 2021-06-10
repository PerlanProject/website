<?php

/**
 * Adds Business Trade Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Business_Trade
 *
 * @param null
 * @return null
 *
 */
function business_trade_widgets($widgets)
{
    $theme_widgets = array(
        'Business_Trade_Welcome_Msg_Widget',
        'Business_Trade_Call_To_Action_Widget',
        'Business_Trade_Contact_Us_Widget',
        'Business_Trade_Faq_Widget',
        'Business_Trade_Our_Services_Widget',
        'Business_Trade_Quote_Widget',
        'Business_Trade_Recent_Post_Widget',
        'Business_Trade_Services_Widget',
        'Business_Trade_Social_Widget',
        'Business_Trade_Testimonial_Widget',
        
       
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('business-trade');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'business_trade_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Business_Trade
 *
 * @param null
 * @return null
 *
 */
function business_trade_widgets_tab($tabs)
{
    $tabs[] = array(
        'title'  => __('Business Trade Widgets', 'business-trade'),
        'filter' => array(
            'groups' => array('business-trade')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'business_trade_widgets_tab', 20);