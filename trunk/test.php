<?php
header('Content-type: image/png');

$font = './Lucida Sans Demibold Roman.ttf';
$font_size = 10;

$fp_port0 = '/var/www/test/tcm-portfolio.png';

$template = imagecreatefrompng($fp_port0);

$width = imagesx($template);
$height = imagesy($template);

$canvas = imagecreatetruecolor($width, $height);

imagecopy($canvas, $template, 0, 0, 0, 0, $width, $height);
imagedestroy($template);

$black = imagecolorallocate($canvas,   0,   0,   0);
$red   = imagecolorexact($canvas, 168,   40,   47);

$text = 'MAKER';

$bbox = imageftbbox($font_size, 0, $font, $text);

//$x = $bbox[0] + ($width / 2) - ($bbox[4] / 2) - ($font_size / 2);
//$y = $bbox[1] + ($height / 2) - ($bbox[5] / 2) - ($font_size / 2);


$x = 160;

imagefttext($canvas, $font_size, 0, 80, 420, $red, $font, $text);
imagefttext($canvas, $font_size, 0, $x, 420, $black, $font, "Bryan Smith");
imagefttext($canvas, $font_size, 0, 80, 440, $red, $font, "Title");
imagefttext($canvas, $font_size, 0, $x, 440, $black, $font, "Automated portfolio page creator");



imagepng($canvas);
imagedestroy($canvas);
?>
