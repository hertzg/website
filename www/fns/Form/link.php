<?php

namespace Form;

function link ($text, $title, $href) {
    include_once __DIR__.'/association.php';
    return association(
        "<a class=\"clickable link form-link\" href=\"$href\">$title</a>",
        "<label>$text:</label>"
    );
}
