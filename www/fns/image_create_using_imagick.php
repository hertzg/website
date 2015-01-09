<?php

function image_create_using_imagick ($filename) {

    if (!class_exists('Imagick')) return false;

    try {
        $imagick = new Imagick($filename);
    } catch (ImagickException $e) {
        return false;
    }

    $width = $imagick->getImageWidth();
    $height = $imagick->getImageHeight();

    $image = imagecreatetruecolor($width, $height);

    $index = 0;
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $pixel = $imagick->getImagePixelColor($x, $y)->getColor();
            $a = 127 - $pixel['a'] * 127;
            $r = $pixel['r'];
            $g = $pixel['g'];
            $b = $pixel['b'];
            $color = ($a << 24) | ($r << 16) | ($g << 8) | $b;
            imagesetpixel($image, $x, $y, $color);
            $index += 4;
        }
    }

    return $image;

}
