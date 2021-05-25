<?php
/**
 * Template Name: Perlan data utilies
 *
 * @package perlan
 */
get_header();
?>

<H1>Perlan Utilities</H1>
<main id="main" class="site-main" role="main">

	<div class="entry-content">
	<?php 
        the_post();
        $action = $_GET["action"];
        
        switch ($action) {

        	// Flights
        		
            case "import-flights":
            	$filename = "../data/flights.csv";
            	$post_type = "flight";
            	
            	import_records($filename, $post_type);
            	break;
            	
            case "delete-flights":
            	delete_records('flight');
            	break;
            	
            case 'test-flights':
            	if (function_exists('query_flights')) {
            		query_flights();
            	} else {
            		echo 'ERROR: function ' . 'query_flights' . ' not found';
            	}
            	break;
            	
            // Soundings
            	
            case "import-soundings":
            	$filename = "../data/soundings.csv";
            	$post_type = "sounding";
            	
            	import_records($filename, $post_type);
            	break;
            
            case "delete-soundings":
            	delete_records('sounding');
            	break;
            	
            case 'test-soundings':
            	query_soundings();
            	break;
                
            ///
            
            default:
            	echo 'ERROR: Unrecognized switch action <b>' . $action . '</b><br>';
        }

    ?>
	</div><!-- .entry-content -->

</main><!-- #main -->

<?php 
//get_footer();
?>