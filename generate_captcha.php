<?php
session_start();

// Generate a random CAPTCHA code (a combination of letters and numbers)
function generateCaptchaCode($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $captchaCode = '';

    for ($i = 0; $i < $length; $i++) {
        $captchaCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $captchaCode;
}

// Create a CAPTCHA code and store it in a session variable
$captchaCode = generateCaptchaCode();
$_SESSION['captcha_code'] = $captchaCode;

// Create an image with CAPTCHA text
$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);

// Set background color
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $backgroundColor);

// Set text color
$textColor = imagecolorallocate($image, 0, 0, 0);

// Set the font URL from Google Fonts
$fontUrl = 'https://fonts.googleapis.com/css2?family=Roboto:wght@700';

// Place the CAPTCHA text on the image using the selected font
imagettftext($image, 20, 0, 10, 30, $textColor, $fontUrl, $captchaCode);

// Output the image as PNG
header('Content-Type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>