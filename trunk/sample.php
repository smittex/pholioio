<?php
// Enable debugging
ini_set("display_errors","1");
ERROR_REPORTING(E_ALL);

$DEBUG = false;
$STATS = false;

$font = './Verdana.ttf';
$font_size = 12;

$max_main_width = 423;  // Max rendered length, in pixels, per line

$materials = $_POST['materials'];
//$maker_name = $_POST['maker_name'];
//$project_name = $_POST['project_name'];
//$completion = $_POST['completion'];
//$process = $_POST['process'];

$materials_words = explode(" ", $materials);  // Split input into array or words
$rev_words = array_reverse($materials_words);  // Reverse the array of words to use as a stack

// Not used yet
//$canvas = cairo_image_surface_create(CAIRO_FORMAT_ARGB32, 50, 50);
//$brush = cairo_create($canvas);
//$extents = cairo_font_extents($brush);

// Determine width & height of rendered variable
$bbox = imagettfbbox($font_size, 0, $font, $materials);
$width = $bbox[2] - $bbox[0];
$height = $bbox[1] - $bbox[5];

// Some stats
$length = strlen($materials);
$ppc = $width/$length;
$num_chars = $max_main_width/$ppc;
$num_lines = ceil($length*$ppc/$max_main_width);
$num_words = count($materials_words);

if ($STATS){
	echo 'materials: ' .$materials .'<br/>';
	echo 'strlen: ' .$length .'<br/>';
	echo 'width: ' .$width .'<br/>';
	echo 'pixels/char: ' .$ppc .'<br/>';
	echo 'chars/line: ' .$num_chars .'<br/>';
	echo 'lines: ' .$num_lines .'<br/>';
	echo 'words: ' .$num_words .'<br/><br/>';
}

$lines[] = array(); // An array of arrays of words; 1st index: line number
$num_line = 0; // Starting line index of 2D array

do
{
  $line = '';

  $word = array_pop($rev_words);  //Get first word
  array_push($lines[$num_line], $word);  // Push the word to the $lines array

  $line .= implode(' ', $lines[$num_line]); // Convert the $lines[$num_line] array to a string
  $line_len = getLength($line); // Get TTF Bounding Box length of string

if ($DEBUG){
	echo 'word: ' .$word .'<br/>';
	echo 'num_line: ' .$num_line .'<br/>';
	echo var_dump($lines[$num_line]) .'<br/>';
  	echo 'line: ' .$line .'<br/>';
	echo 'len: ' .$line_len .'<br/><br/>';
}

  if ($line_len > $max_main_width)  // Get rendered length of line
  {
    array_pop($lines[$num_line]);
    array_push($rev_words, $word);
    $num_line += 1;
    $lines[] = array();
  }
} while (count($rev_words) > 0);

echo 'resultant lines: ' .count($lines) .'<br/>';

for ($i = 0; $i < count($lines); $i++)
{
  echo 'line ' .$i .': ' .implode(' ',$lines[$i]) .'<br/>';
}

function getLength($candidate){
  global $font_size, $font;

  $bbox = imagettfbbox($font_size, 0, $font, $candidate);
  return ($bbox[2] - $bbox[0]);
}

function breakdown($string, $max_length, $font_path, $font_size) as array(){
  $_words = explode(" ", $string);            // Split input into array of words
  $rev_words = array_reverse($_words);        // Reverse the array of words to use as a stack

  $lines[] = array();                         // An array of arrays of words; 1st index: line number
  $num_line = 0;                              // Starting line index of 2D array

  do
  {
    $line = '';

    $word = array_pop($rev_words);            //Get first word
    array_push($lines[$num_line], $word);     // Push the word to the $lines array

    $line .= implode(' ', $lines[$num_line]); // Convert the $lines[$num_line] array to a string
    $line_len = getLength($line);             // Get TTF Bounding Box length of string

    if ($line_len > $max_main_width){         // Get rendered length of line
      array_pop($lines[$num_line]);
      array_push($rev_words, $word);
      $num_line += 1;
      $lines[] = array();
    }
  } while (count($rev_words) > 0);

  return $lines;
}
?>

