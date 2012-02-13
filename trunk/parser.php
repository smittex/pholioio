<?php
/*
 * Name: pholioio
 * Author: Bryan Smith
 * Date: 2012/02/10
 * Description: This application presents a form to a web user
 * and takes the input and generates an SVG with the input
 * embedded within it.
 * Future: This application aims to be an SVG template engine
 * 
 */


$font = './includes/fonts/Verdana.ttf';
$font_size = 12;
	


header('Content-type: image/svg+xml');

$file = './includes/templates/1/tcm-portfolio.svg';
$fp = fopen($file, 'r');
$xml = fread($fp, filesize($file));

$svg = new SimpleXMLElement($xml);

$g = $svg->g;

{ // Header section
$header_style = 'font-size:9.6px;text-align:end;text-anchor:end;fill:#a8292f;fill-opacity:1;font-family:Garuda;';
$group = $svg->addChild('g');
$group->addAttribute('id', 'header');

$tempvar = $group->addChild('text', 'maker');
$tempvar->addAttribute('style', $header_style);
$tempvar->addAttribute('x', '125');
$tempvar->addAttribute('y', '420');

$tempvar = $group->addChild('text', 'project title');
$tempvar->addAttribute('style', $header_style);
$tempvar->addAttribute('x', '125');
$tempvar->addAttribute('y', '440');

$tempvar = $group->addChild('text', 'materials used');
$tempvar->addAttribute('style', $header_style);
$tempvar->addAttribute('x', '125');
$tempvar->addAttribute('y', '460');

$tempvar = $group->addChild('text', 'process &amp; function');
$tempvar->addAttribute('style', $header_style);
$tempvar->addAttribute('x', '125');
$tempvar->addAttribute('y', '490');
}

{ // Input fields section
$input_style = 'font-size:9.6px;fill:#231f20;fill-opacity:1;font-family:Verdana';
$group = $svg->addChild('g');
$group->addAttribute('id', 'input');

$tempvar = $group->addChild('text', 'Christopher Odegard');
$tempvar->addAttribute('style', $input_style);
$tempvar->addAttribute('x', '135');
$tempvar->addAttribute('y', '420');

$tempvar = $group->addChild('text', 'Tantalus — carrying case for spirits tasting glassware');
$tempvar->addAttribute('style', $input_style);
$tempvar->addAttribute('x', '135');
$tempvar->addAttribute('y', '440');

$wood_text = 'woods: cherry, cherry burl, walnut, spanish cedar, and wenge; off-the-rack ' . 
	'and custom brass hardware; french-fit foam lined with synthetic black velvet';

$text_arr = breakdown($wood_text, 600, $font, 9.6);

$y = 460;

foreach($text_arr as $line) {
	$text = implode(' ', $line);
	$tempvar = $group->addChild('text', $text);
	
	$tempvar->addAttribute('style', $input_style);
	$tempvar->addAttribute('x', '135');
	$tempvar->addAttribute('y', $y);
	
	$y += 10;
}

$y += 10;

$fill_text = 'Quadrupei pessimus libere senesceret pretosius umbraculi, iam apparatus bellis vocificat optimus perspicax ' . 
	'zothecas, et verecundus concubine frugaliter senesceret umbraculi. Perspicax saburre neglegenter praemuniet bellus ' . 
	'cathedras. Ossifragi vocificat Octavius. Caesar suffragarit adlaudabilis fiducias. Augustus agnascor adfabilis ' . 
	'agricolae, ut cathedras pessimus comiter conubium santet umbraculi, semper pretosius agricolae vocificat adfabilis ' . 
	'quadrupei, et optimus lascivius. Rures praemuniet saburre.';

$text_arr = breakdown($fill_text, 600, $font, 9.6);

foreach($text_arr as $line) {
	$text = implode(' ', $line);
	$tempvar = $group->addChild('text', $text);
	
	$tempvar->addAttribute('style', $input_style);
	$tempvar->addAttribute('x', '135');
	$tempvar->addAttribute('y', $y);
	
	$y += 10;
}



}

{ // Biography section
$bio_style = 'font-size:7.5px;font-weight:300;fill:#231f20;fill-opacity:1;font-family:CorporateS;';
$group = $svg->addChild('g');
$group->addAttribute('id', 'maker-bio');

// Need to break this up into lines
$bio_text = 'Christopher Odegard is a graphic designer by trade and an amateur wood craftsman by inclination. He ' . 
	'currently serves as interim department head for the wood shop and CNC areas, and has been a TC Maker member ' . 
	'since August 2011. His personal interests include: being a father, fine woodworking with emphasis on hand-tools ' . 
	'and traditional craft techniques,fine spirits &amp; good food, audio electronics, geocaching, hand-drums, as ' . 
	'well as fine art, music and film appreciation.';

$text_arr = breakdown($bio_text, 575, $font, 7.5);

$y = 680;

foreach($text_arr as $line) {
	$text = implode(' ', $line);
	$tempvar = $group->addChild('text', $text);
	
	$tempvar->addAttribute('style', $bio_style);
	$tempvar->addAttribute('x', '160');
	$tempvar->addAttribute('y', $y);
	
	$y += 10;
}


}

echo $svg->asXML();

// Adding an image
/*
$image = $group->addChild('image');
$image->addAttribute('x', '100');
$image->addAttribute('y', '100');
$image->addAttribute('height', '1');
$image->addAttribute('width', '1');
$image->addAttribute('xlink:href', 'data:image/png;base64,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');
*/

function breakdown($text, $width, $font, $font_size){
	$text_words = explode(" ", $text);  // Split input into array or words
	$rev_words = array_reverse($text_words);  // Reverse the array of words to use as a stack
	
	$lines[] = array(); // An array of arrays of words; 1st index: line number
	$num_line = 0; // Starting line index of 2D array

	do
	{
	  $line = '';
	
	  $word = array_pop($rev_words);  //Get first word
	  array_push($lines[$num_line], $word);  // Push the word to the $lines array
	
	  $line .= implode(' ', $lines[$num_line]); // Convert the $lines[$num_line] array to a string
	  $line_len = getLength($line, $font, $font_size); // Get TTF Bounding Box length of string
	
	  if ($line_len > $width)  // Get rendered length of line
	  {
	    array_pop($lines[$num_line]);
	    array_push($rev_words, $word);
	    $num_line += 1;
	    $lines[] = array();
	  }
	} while (count($rev_words) > 0);
	
	return $lines;
}


function getLength($candidate, $font, $font_size){
  $bbox = imagettfbbox($font_size, 0, $font, $candidate);
  return ($bbox[2] - $bbox[0]);
}

?>