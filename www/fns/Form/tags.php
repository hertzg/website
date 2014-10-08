<?php

namespace Form;

function tags ($base, $tags) {

    $value = '<div class="textAndButtons">';
    foreach ($tags as $tag) {
        $escapedTag = htmlspecialchars($tag);
        $href = "$base../?tag=$escapedTag";
        $value .= "<a class=\"tag\" href=\"$href\">$escapedTag</a>";
    }
    $value .= '</div>';

    include_once __DIR__.'/association.php';
    return association($value, '<label>Tags:</label>');

}
