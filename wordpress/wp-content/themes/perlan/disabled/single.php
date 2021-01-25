
<?php 

get_header();

echo 'HELLO from single';

$plot = '
[plotly]
{
  "data": [{
    "x": [1, 2, 3, 4],
    "y": [27, 28, 29, 50],
    "mode": "lines+markers",
    "type": "scatter"
  }],
  "layout": {
    "margin": {
      "t": 40, "r": 40, "b": 40, "l":40
    }
  }
}
[/plotly]
';

$short = do_shortcode($plot);
echo $short;

get_footer();
?>

