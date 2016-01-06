<?php

namespace ColorTag;

function render ($tags, $paint) {
    $html = '';
    if (!$paint) $styleAttribute = '';
    include_once __DIR__.'/colors.php';
    foreach ($tags as $i => $tag) {

        if ($i) $html .= ' ';

        if ($paint) {
            colors($tag, $borderColor, $backgroundColor);
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
