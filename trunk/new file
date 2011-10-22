<?php
  header('Content-type: image/png');

  $img=imagecreatetruecolor(420,100);

  $fill_color=imagecolorallocate($img,220,230,235);

  $text_color=imagecolorallocate($img,30,64,90);

  imagefilledrectangle($img,0,0,420,100,$fill_color);

  imagerectangle($img,1,1,418,98,$text_color);

  imagestring($img, 1, 5, 5, 'Hello World!', $text_color);

  imagepng($img);
  imagedestroy($img);

?>
