<?php

namespace Form;

function filefield ($name, $text) {
    include_once __DIR__.'/association.php';
    return association(
        '<input class="form-filefield" type="file" multiple="multiple"'
        ." id=\"$name\" name=\"$name\" />",
        "<label for=\"$name\">$text</label>"
    );
}
