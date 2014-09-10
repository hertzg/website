<?php

namespace Form;

function filefield ($name, $text, $options) {

    $multipleAttribute = '';
    if (array_key_exists('multiple', $options) && $options['multiple']) {
        $multipleAttribute = ' multiple="multiple"';
    }

    $requiredAttribute = '';
    if (array_key_exists('required', $options) && $options['required']) {
        $requiredAttribute = ' required="required"';
    }

    include_once __DIR__.'/association.php';
    return association(
        '<input class="form-filefield" type="file"'
        ."$multipleAttribute$requiredAttribute"
        ." id=\"$name\" name=\"$name\" />",
        "<label for=\"$name\">$text:</label>"
    );
}
