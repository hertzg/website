<?php

namespace Form;

function link ($text, $title, $href, $icon) {
    include_once __DIR__.'/association.php';
    return association(
        "<a class=\"clickable link form-link\" href=\"$href\">"
            ."<span class=\"icon $icon\"></span>"
            .$title
        .'</a>',
        "<label>$text:</label>"
    );
}
