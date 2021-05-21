<?php
/**
 * Template Name: test page template
 *
 * @package perlan
 */
get_header();
?>

<H1>CSV test page</H1>
<?php echo 'Hello, World!';?>
<main id="main" class="site-main" role="main">

<div class="entry-content">
<?php 
	the_post();

	$arr = get_posts(
		array(
			'post_type' => 'flight',
			'relation' => 'AND',
			'meta_query' => array(
				'flight_clause' => array(
					'key' => 'flight_number',
					'value' => '65',
				),
			),
			'orderby' => 'flight_number',
			'order' => 'ASC',
			'exact' => true,
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
					
					echo('flight_number= ' . $elm->flight_number . "<br>");
					echo('data_kml= ' . $elm->data_kml . "<br>");
					//echo('ID= ' . $elm->ID . "<br>");
					//echo('post_title= ' . $elm->post_title . "<br>");
					//echo('PIC= ' . $elm->pic . "<br>");
					//echo('takeoff_time= ' . $elm->takeoff_time . "<br>");
		}
	}
	
	?>
	</div><!-- .entry-content -->

</main><!-- #main -->

<?php 
get_footer();
?>