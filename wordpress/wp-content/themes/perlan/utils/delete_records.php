<?php
/*
 * Plugin Name: Perlan
 * Description: Creates Flight and Sounding CPTs from CSV file
 * Author: jdm
 * Version: 1.0.0
 */
function delete_records($post_type = "flight") {
	echo '<H1>Deleting records (posts) of post_type ' . $post_type . '</H1>';
	
	// safety check: don't delete just any post type...
	switch ($post_type) {
		case 'flight':
		case 'sounding':
			break;
		default:
			echo "<b><H1>ERROR: deleting post_type " . $post_type . " is not allowed here!!</H1></b>";
			return;
	}
	
	$arr = get_posts(
		array(
			'post_type'		=> $post_type,
			'numberposts'	=> -1,
		),
	);
	$nr_posts = count($arr);
	echo 'Number of records (posts) found: ' . $nr_posts . '<br>';
	if ($nr_posts == 0) return;
	
	foreach ( $arr as $rec ) {
		$post = get_post( $rec );
		echo 'post_title: ' . $post->post_title . '<br>';
		$err = wp_delete_post($post->ID, True);	// force delete
		if (is_wp_error($err)) {
			$msg = $err->get_error_message();
			echo "ERROR: " . $msg . "<br>";
		}
	}
}

