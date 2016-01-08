<?php

namespace ColorTag;

function render ($tags, $paint) {
    $html = '';
    if (!$paint) $styleAttribute = '';
    include_once __DIR__.'/style.php';
    foreach ($tags as $i => $tag) {

        if ($i) $html .= ' ';

        if ($paint) $styleAttribute = ' style="'.style($tag).'"';

        $html .=
            "<span class=\"colorTag\"$styleAttribute>"
                .htmlspecialchars($tag)
            .'</span>';

    }
    return $html;
}
