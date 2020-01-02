<?php
// Set the content-type
header('Content-Type: image/png');

// Define the Captcha dimensions in Pixels
define('width', 180);
define('height', 40);
define('textwidth', 90);
define('textheight', 22);

// Create the image with the dimensions above
$im = imagecreatetruecolor(width, height);

// Define some colors to use on the captcha
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

// Set the image background as 
imagefilledrectangle($im, 0, 0, width, height, $white);

// The text to draw - here we are getting a URL param with the string
$text = base64_decode($_REQUEST['hash']);
// $text = $_REQUEST['hash'];

// Replace path by your own font path
$font = getcwd() . '/fonts/pixelate.ttf';

// define text parameters
$fontsize = 21;
$angle = mt_rand(-2, 2);
$posx = mt_rand(2, width - textwidth);
$posy = mt_rand(textheight, height - 2);

// Add the text to the image
imagettftext($im, $fontsize, $angle, $posx, $posy, $black, $font, $text);

// We now have a clean image with the text - we now add noise pixels all over:

//Black noise - here we iterate with a 33% chance of a pixel being black
for ($y = 0; $y < height; $y++) {
    for ($x = 0; $x < width; $x++) {
        if (mt_rand(0, 2) == 2) {
            imagesetpixel($im, $x, $y, $black);
        }
    }
}
//White Noise - here we iterate with a 5% chance of a pixel being white
for ($y = 0; $y < height; $y++) {
    for ($x = 0; $x < width; $x++) {
        if (mt_rand(0, 20) == 7) {
            imagesetpixel($im, $x, $y, $white);
        }
    }
}

// Using imagepng() results in a sharper image as it is lossless
imagepng($im);
imagedestroy($im);
