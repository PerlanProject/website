<?php
/*
 Plugin Name: Perlan
 Description: Support for Perlan theme
 Author: jdm
 Version: 1.0.0
 */

function perlan_action_hook () {
    echo '<H1>Hello from perlan plugin::perlan_action_hook</H1>';
}
//add_action('init', 'perlan_flight_cpt');

 
add_action('get_content', 'perlan_action_hook');

//<?php
