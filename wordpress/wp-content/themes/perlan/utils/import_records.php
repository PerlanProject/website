<?php
/*
 * Plugin Name: Perlan
 * Description: Creates records (posts of Custom Post Type 'flight', 'sounding', etc.) by importing from CSV file
 * Author: jdm
 * Version: 1.0.0
 */
function import_records($filename = "../data/flights.csv", $post_type = "flight", $print_csv_values=False, $create_posts=True) {
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
	
	while (! feof($file)) { // read line-by-line
		$values = fgetcsv($file);
		if (empty($values)) {
			echo 'WARNING: empty line in CSV, ignoring';
			return;
		}
		$comb = array_combine($names, $values); // create a proper key/val array
		
		switch ($post_type) {
			
			case 'flight':
				// deal with flight_number: zero-pad to four places, e.g., "0069"
				$flight_number = intval($comb['flight_number']);
				if ($flight_number == 0) {
					continue;
				}
				$title = 'Flight ' . sprintf("%04d", $flight_number); // dump_values is for debugging: echoes the key/val pairs
				break;
			
			case 'sounding':
				$title = $comb['ts'];
				break;
				
			default:
				echo 'ERROR: Unrecognized post_type: <b>' . $post_type . '</b>';
				return;
		}
				
		if ($print_csv_values) {
			echo '<H3>Row key/val pairs</H3>';
			foreach ($comb as $key => $val) {
				echo 'key: ' . $key . ' val: ' . $val . "<br>";
			}
		}
		
		if ($create_posts) {
			// create_the PODS records as Custom Post Types (CPT)
			$existing = get_posts(array(
				'post_type' => $post_type,
				'title' => $title, // NOTE: not 'post_title' as you'd expect :-(
				'numberposts' => - 1,
				'exact' => true
			));
			if (count($existing)) {
				echo "Post " . $title . " exists already (count=" . count($existing) . "), skipping <br>";
				$existing = null;
				continue;
			}
			
			echo "Creating post '$title' <br>";
			print_r($comb);
			echo "<br>";
			
			$err = wp_insert_post(array(
				"post_title" => $title,  // NOTE: wp_insert_post() uses "post_title" but get_posts() uses "title". Sigh.
				"post_type" => $post_type,
				"post_status" => "publish",
				"meta_input" => $comb
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

