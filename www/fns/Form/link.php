<?php

namespace Form;

function link ($text, $title, $href, $icon) {
    include_once __DIR__.'/association.php';
    include_once __DIR__.'/../Page/imageLink.php';
    return association(
        \Page\imageLink($title, $href, $icon),
        "<label>$text:</label>"
    );
}
