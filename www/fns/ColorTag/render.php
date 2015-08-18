<?php

namespace ColorTag;

function render ($tags, $text_luminance, $paint) {
    $html = '';
    if (!$paint) $style = "color: hsl(0, 0%, $text_luminance%)";
    foreach ($tags as $i => $tag) {

        if ($i) $html .= ' ';

        $hash = md5($tag);

        if ($paint) {

            $hue = floor(hexdec(substr($hash, 0, 4)) / 1024 * 360);
            $saturation = 40 + floor(hexdec(substr($hash, 4, 2)) / 255 * 60);
            $luminance = 30 + floor(hexdec(substr($hash, 6, 2)) / 255 * 40);
            $borderColor = "hsl($hue, $saturation%, $luminance%)";
            $saturation -= 20;
            $color = "hsl($hue, $saturation%, $text_luminance%)";
            $luminance += 10;
            $backgroundColor = "hsla($hue, $saturation%, $luminance%, 0.5)";

            $style = "background-color: $backgroundColor;\n"
                ." color: $color; border-color: $borderColor";

        }

        $html .=
            "<span class=\"colorTag\" style=\"$style\">"
                .htmlspecialchars($tag)
            .'</span>';

    }
    return $html;
}
