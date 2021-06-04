<?php
/*
 * Plugin Name: Perlan
 * Description: Creates records (posts of Custom Post Type 'flight', 'sounding', etc.) by importing from CSV file
 * Author: jdm
 * Version: 1.0.0
 */
function import_records($filename = "../data/flights-toolset.csv") {
	$filename = "../data/flights-toolset.csv";  // debug HACK!!
	$print_csv_values=True;
	$create_posts=True;
	
	echo '<H2>Importing CSV ' . $filename . '</H2>';
	
	$file = fopen($filename, "r");
	$names = fgetcsv($file); // the first row is column names
	
	/*
	 * GAAAA!!! Skip the !#$%!#$%#@%! CSV BOM characters that fgetcsv does not.
	 * BOM characters are 3 characters at the start of the file describing its endian-ness. Not
	 * all CSV files have them, but Mac apps and Excel do write them. Certainly php's fgetcsv
	 * should take care of this for us. But it doesn't, so we have to.
	 */
	$names[0] = preg_replace('/[^\\x20-\\x7E]/', '', $names[0]);
	
	while (! feof($file)) {
		
		// Read one row of the CSV, as a key/value pair
		$values = fgetcsv($file);
		if (empty($values)) {
			echo 'WARNING: empty line in CSV, ignoring';
			return;
		}
		$dict = array_combine($names, $values); // create a proper key/val array
		
		// Assign vars for WP Post params; everything else goes in meta
		$post_type = "";
		$post_title = "";
		$post_content = "";
		$post_excerpt = "";
		$post_categories = "";
		$post_tags = "";
		$meta = [];
		foreach ($dict as $key => $val) {
			if ($print_csv_values) {
				echo 'raw CSV key: ' . $key . ' val: ' . $val . "<br>";
			}
			
			switch ($key) {
				case 'post_type':
				case 'csv_post_type':
					$post_type = $val;
					break;
				
				case 'post_name':
				case 'csv_post_name':
				case 'post_title':
				case 'csv_post_title':
					$post_title = $val;
					break;
				
				case 'post_content':
				case 'post_post':
				case 'csv_post_post':
					$post_content = $val;
					break;
					
				case 'post_excerpt':
				case 'csv_post_excerpt':
					$post_excerpt = $val;
					break;
					
				case 'post_categories':
				case 'csv_post_categories':
					$post_categories = $val;
					break;
					
				case 'post_tags':
				case 'csv_post_tags':
					$post_tags = $val;
					break;
					
				default:
					$meta[$key] = $val;
					break;
			}
			
		}
		
		// Create the post
		if ($create_posts) {
			$existing = get_posts(array(
				'post_type' => $post_type,
				'title' => $post_title,				// GAAAA!!! 'title' not 'post_title' !!
				'numberposts' => -1,
				'exact' => true
			));
			if (count($existing)) {
				echo "Post " . $post_title . " exists already (count=" . count($existing) . "), skipping <br>";
				$existing = null;
				continue;
			}
			
			echo "Creating post '$post_title' <br>";
			print_r($meta);
			echo "<br>";
			
			$err = wp_insert_post(array(
				'post_type' => $post_type,
				"post_title" => $post_title,
				"post_content" => $post_content,
				'post_excerpt' => $post_excerpt,
				'post_categories' => $post_categories,
				'post_tags' => $post_tags,
				"post_status" => "publish",
				"meta_input" => $meta
			), true);
			if (is_wp_error($err)) {
				$msg = $err->get_error_message();
				echo "ERROR creating post (wp_insert_post): " . $msg . "<br>";
			}
		}
	}
	echo "<br>";
	
	fclose($file);
}

