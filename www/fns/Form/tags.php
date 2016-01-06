<?php

namespace Form;

function tags ($base, $tags) {

    include_once __DIR__.'/../ColorTag/style.php';
    $value = '<div class="textAndButtons">';
    foreach ($tags as $tag) {
        $style = \ColorTag\style($tag);
        $href = "$base../?tag=".rawurlencode($tag);
        $value .=
            "<a class=\"tag\" style=\"$style\" href=\"$href\">"
                .htmlspecialchars($tag)
            .'</a>';
    }
    $value .= '</div>';

    include_once __DIR__.'/association.php';
    return association($value, 'Tags:');

}
