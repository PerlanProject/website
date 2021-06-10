<?php
/*
 * Child Theme created for illustratr
 * Created by jdm 
 * Theme: perlan
 * */

function my_stylesheeted_theme_enqueue_styles() {
    $theme = wp_get_theme();
    $parenthandle = 'illustratr';
	//
    // load the parent theme style
    wp_enqueue_style($parenthandle, get_template_directory_uri() . '/style.css',
		array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    
    // load our style, which over-rides it
    wp_enqueue_style( 'perlan', get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get('Version') // this only works if you have Version in the style header
    );
}
add_action( 'wp_enqueue_scripts', 'my_stylesheeted_theme_enqueue_styles' );


// you must register any and all functions, via require_once()
require_once(dirname(__FILE__) . '/utils/' . 'delete_records.php');
require_once(dirname(__FILE__) . '/utils/' . 'import_records.php');
require_once(dirname(__FILE__) . '/utils/' . 'query_records.php');
require_once(dirname(__FILE__) . '/utils/' . 'query_flights.php');
require_once(dirname(__FILE__) . '/utils/' . 'query_soundings.php');

