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
            	import_records("../data/flights-toolset.csv");
            	break;
            	
            case "delete-flights":
            	delete_records('flight');
            	break;
            	
            case 'test-flights':
				query_records('flight');
            	break;
            	
            // Soundings
            	
            case "import-soundings":
            	import_records("../data/soundings-toolset.csv");
            	break;
            
            case "delete-soundings":
            	delete_records('sounding');
            	break;
            	
            case 'test-soundings':
				query_records('sounding');
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
