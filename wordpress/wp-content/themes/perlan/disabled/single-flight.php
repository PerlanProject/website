<!DOCTYPE html>
<html>
<head>
<title>Yo, baby. Yo.</title>
</head>
<body>
<H1>I'm too sexy for my header</H1>
</body>
</html>  
<?php global $wp_query; print_r($wp_query->post); $wp_query->post->ID; ?>
<b><?php echo $wp_query->post->ID; ?></b>
<?php 
the_content();
?>