<?php

namespace ColorTag;

function render ($tags, $paint) {
    $html = '';
    if (!$paint) $styleAttribute = '';
    foreach ($tags as $i => $tag) {

        if ($i) $html .= ' ';

        if ($paint) {

            $hash = md5($tag);
            $hue = floor(hexdec(substr($hash, 0, 4)) / 1024 * 360);
            $saturation = 40 + floor(hexdec(substr($hash, 4, 2)) / 255 * 60);
            $luminance = 30 + floor(hexdec(substr($hash, 6, 2)) / 255 * 40);
            $borderColor = "hsl($hue, $saturation%, $luminance%)";
            $saturation -= 20;
            $luminance += 10;
            $backgroundColor = "hsla($hue, $saturation%, $luminance%, 0.5)";

            $style = "border-color: $borderColor;"
                ." background-color: $backgroundColor";
            $styleAttribute = " style=\"$style\"";

        }

        $html .=
            "<span class=\"colorTag\"$styleAttribute>"
                .htmlspecialchars($tag)
            .'</span>';

    }
    return $html;
}
