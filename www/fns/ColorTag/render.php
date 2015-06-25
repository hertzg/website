<?php

namespace ColorTag;

function render ($tags, $paint = false) {
    $html = '';
    if (!$paint) {
        $styleAttribute = ' style="background-color: #eee; color: #555"';
    }
    foreach ($tags as $i => $tag) {

        if ($i) $html .= ' ';

        $hash = md5($tag);

        if ($paint) {

            $hue = floor(hexdec(substr($hash, 0, 4)) / 1024 * 360);
            $saturation = 20 + floor(hexdec(substr($hash, 4, 2)) / 255 * 80);
            $luminance = 15 + floor(hexdec(substr($hash, 6, 2)) / 255 * 70);
            $borderColor = "hsl($hue, $saturation%, $luminance%)";
            $saturation -= 20;
            $color = "hsl($hue, $saturation%, 10%)";
            $background = "hsla($hue, $saturation%, $luminance%, 0.5)";

            $background = "background: $background";
            $color = "color: $color";
            $borderColor = "border-color: $borderColor";
            $styleAttribute = " style=\"$background;$color;$borderColor\"";

        }

        $html .=
            "<span class=\"colorTag\"$styleAttribute>"
                .htmlspecialchars($tag)
            .'</span>';

    }
    return $html;
}
