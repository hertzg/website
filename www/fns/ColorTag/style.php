<?php

namespace ColorTag;

function style ($tag) {
    $hash = md5($tag);
    $hue = floor(hexdec(substr($hash, 0, 4)) / 1024 * 360);
    $saturation = 40 + floor(hexdec(substr($hash, 4, 2)) / 255 * 60);
    $luminance = 30 + floor(hexdec(substr($hash, 6, 2)) / 255 * 40);
    $borderColor = "hsl($hue, $saturation%, $luminance%)";
    $saturation -= 20;
    $luminance += 10;
    $backgroundColor = "hsla($hue, $saturation%, $luminance%, 0.5)";
    return "border-color: $borderColor; background-color: $backgroundColor";
}
