<?php
/*
 * Plugin Name: perlan
 * Description: test queries of 'sounding' posts
 * Author: jdm
 * Version: 1.0.0
 */
function query_soundings() {
	$arr = get_posts(
		array(
			'post_type' => 'sounding',
			'numberposts' => 1,
		),
		);
	if (is_wp_error($arr)) {
		$msg = $arr->get_error_message();
		echo "ERROR: " . $msg . "<br>";
	} else {
		print("Number of posts: " . count($arr) . "\r\n");
		foreach ( $arr as $elm) {
			echo '<li><a href="'
				. get_permalink( $elm->ID ) . '">'
					. $elm->post_title . '</a></li>';
					
					echo('ID= ' . $elm->ID . "<br>");
					echo('KML file= ' . $elm->kml_file . "<br>");
					echo('raw_data = ' . $elm->raw_data . "<br>");
					echo('graphs_dir = ' . $elm->graphs_dir . "<br>");
		}
	}
	
}

