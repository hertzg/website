<?php

namespace Form;

function filefield ($name, $text, $options) {

    $multipleAttribute = '';
    if (array_key_exists('multiple', $options) && $options['multiple']) {
        $multipleAttribute = ' multiple="multiple"';
    }

    include_once __DIR__.'/association.php';
    return association(
        "<input class=\"form-filefield\" type=\"file\"$multipleAttribute"
        ." id=\"$name\" name=\"$name\" />",
        "<label for=\"$name\">$text:</label>"
    );
}
