<?php

$font = './Verdana.ttf';

// First we create our bounding box for the first text
$bbox = imagettfbbox(10, 0, $font, $_GET['text']);

// This is our cordinates for X and Y
$x = $bbox[4] - $bbox[0];
$y = $bbox[1] - $bbox[5];

echo 'x: ' .$x;
echo '<br />';
echo 'y: ' .$y;
?>
