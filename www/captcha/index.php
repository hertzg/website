<?php

include_once '../../lib/defaults.php';

$chars = str_repeat('23456789abcdefghijkmnpqrstuvwxyz', 4);
$chars = str_shuffle($chars);
$captcha = substr($chars, -5);

include_once '../fns/session_start_custom.php';
session_start_custom($new);

$_SESSION['captcha'] = $captcha;
session_commit();

$width = 102;
$height = 40;
$image = imagecreatetruecolor($width, $height);
imagefilledrectangle($image, 0, 0, $width, $height, 0xeeeeee);
foreach (str_split($captcha) as $i => $char) {
    $size = rand(13, 16);
    $angle = rand(-30, 30);
    $x = 10 + $i * 17 + rand(-4, 4);
    $y = 26 + rand(-9, 9);
    imagettftext($image, $size, $angle, $x, $y, 0, './index.ttf', $char);
}

header('Content-Type: image/png');
imagepng($image);
