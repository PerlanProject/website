<?php
/**
 * Template Name: dbimport page template
 *
 * @package perlan
 */

get_header();
?>

<H1>Welcome to the DB Import page template</H1>
<main id="main" class="site-main" role="main">

	<div class="entry-content">
	<?php 
        the_post();
        //the_content();   
        //print("This post's ID: " . $post->ID . "\r\n");
        
        $action = "csv";
            
        switch ($action) {
        	case "none":
        		break;
        		
            case "csv":
            	$flights_filename = "../data/flights.csv";
            	echo '<H2>Importing CSV ' . $flights_filename . '</H2>';
            	
            	$file = fopen($flights_filename,"r");
            	$names = fgetcsv($file);					// the first row is column names           	
            	/*
            	 * GAAAA!!! Skip the !#$%!#$%#@%! CSV BOM characters that fgetcsv does not.
            	 * BOM characters are 3 characters at the start of the file describing its endian-ness. Not
            	 * all CSV files have them, but Mac apps and Excel do write them.  Certainly php's fgetcsv
            	 * should take care of this for us.  But it doesn't, so we have to.
            	 */
            	$names[0] = preg_replace('/[^\\x20-\\x7E]/','', $names[0]);
            	
            	while(! feof($file)) {						// read line-by-line
            		$values = fgetcsv($file);
            		$comb = array_combine($names, $values);	// create a proper key/val array
            		
            		// deal with flight_number
            		$flight_number = intval($comb['flight_number']);
            		if ($flight_number == 0) {
            			continue;
            		}
            		            		
            		$flight_name = 'Flight ' . sprintf("%04d", $flight_number);// dump_values is for debugging: echoes the key/val pairs
            		$dump_values = false;
            		if ($dump_values) {
            			echo '<H3>Row key/val pairs</H3>';
	            		while (list($key, $val) = each($comb)) {
	            			echo 'key: ' . $key . ' val: ' . $val . "<br>";
	            		}
            		}
            		
            		// create_flights: creates the PODS records (CPT) of type flight
            		$create_flights = true;
            		if ($create_flights) {
            			$existing = get_posts(
            				array(
            					'post_type'		=> 'flight',
            					'title'			=> $flight_name,	// NOTE: not 'post_title' as you'd expect :-(
            					'numberposts'	=> -1,
            					'exact'			=> true,
            				)
            			);
            			if (count($existing)) {
            				echo "Post " . $flight_name . " exists already (count=" . count($existing) . "), skipping <br>";
            				$existing = null;
            				continue;
            			}
            			
            			echo "Creating Flight $flight_name <br>";
            			print_r($comb);
            			echo "<br>";
            			
            			$err = wp_insert_post(
            				array(
            					"post_title" => $flight_name,
            					"post_type" => "flight",
            					"post_status" => "publish",
            					"meta_input" => $comb,
            				),
            				true
            				);
            			if (is_wp_error($err)) {
            				$msg = $err->get_error_message();
            				echo "ERROR creating flight (wp_insert_post): " . $msg . "<br>";
            			}
            		}
            		echo "<br>";
            	}
            	
            	fclose($file);
            	break;
            	
            case "delete":
            	echo '<H2>Deleting all flights...</H2>';
            	
            	$arr = get_posts(
            		array(
            			'post_type'		=> 'flight',
            			'numberposts'	=> -1,
            		),
            	);
            	$nr_flights = count($arr);
            	echo 'Number of flights found: ' . $nr_flights . '<br>';
            	if ($nr_flights == 0) break;
            		
            	foreach ( $arr as $rec ) {
            		$post = get_post( $rec );
            		echo 'Flight: ' . $post->post_title . '<br>';
            		$err = wp_delete_post($post->ID, True);
            		if (is_wp_error($err)) {
            			$msg = $err->get_error_message();
            			echo "ERROR: " . $msg . "<br>";
            		}
            	}
            	
            	break;
                
            case "test":
                $arr = get_posts(
                    array(
                        'post_type' => 'flight',
                        'relation' => 'AND',
                        'fields' => array(
                        	'flight_number' => 65,
                        ),
                        'orderby' => 'flight_number',
                        'order' => 'ASC',
                    	'exact' => true,
                        'numberposts' => -1,
                    ),
                );
                if (is_wp_error($err)) {
                    $msg = $err->get_error_message();
                    echo "ERROR: " . $msg . "<br>";
                } else {
	                print("Number of posts: " . count($arr) . "\r\n");
	                foreach ( $arr as $elm) {
	                	echo '<li><a href="'
                    	. get_permalink( $elm->ID ) . '">'
                    	. $elm->post_title . '</a></li>';
	                	
	                	echo('flight_number= ' . $elm->flight_number . "<br>");
	                    echo('ID= ' . $elm->ID . "<br>");
	                    echo('post_title= ' . $elm->post_title . "<br>");
	                    echo('PIC= ' . $elm->pic . "<br>");
	                    echo('takeoff_time= ' . $elm->takeoff_time . "<br>");
	                }
                }
                break;

            default:
            	echo 'Error: switch action ' . $action . ' unknown<br>';
                
        }

    ?>
	</div><!-- .entry-content -->

</main><!-- #main -->

<?php 
//get_footer();
?>