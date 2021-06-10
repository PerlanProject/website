<?php
/*
 * Plugin Name: perlan
 * Description: test queries of 'flight' posts
 * Author: jdm
 * Version: 1.0.0
 */
function query_records($post_type) {
	$arr = get_posts(
		array(
			'post_type' => $post_type,
			'numberposts' => -1,
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

			echo 'ID= ' . $elm->ID . "<br>";
			echo '<H3>Custom Fields</H3>';
			foreach (get_post_custom($elm->ID) as $key => $val) {
				echo '	<b>' . $key . ':</b>		' . $val[0] . "<br>";
			}

		}
	}
	
}

