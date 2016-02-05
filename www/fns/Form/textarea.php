<?php

namespace Form;

function textarea ($name, $text, $options = []) {

    if (array_key_exists('value', $options)) {
        $content = "\n".htmlspecialchars($options['value']);
    } else{
        $content = '';
    }

    if (array_key_exists('maxlength', $options)) {
        $maxlengthAttribute = " maxlength=\"$options[maxlength]\"";
    } else {
        $maxlengthAttribute = '';
    }

    include_once __DIR__.'/association.php';
    include_once __DIR__.'/getBoolAttribute.php';

    return association(
        '<textarea class="form-textarea"'
        .$maxlengthAttribute
        .getBoolAttribute('autofocus', $options)
        .getBoolAttribute('readonly', $options)
        .getBoolAttribute('required', $options)
        ." id=\"$name\" name=\"$name\">$content</textarea>",
        "<label class=\"form-property-label\" for=\"$name\">$text:</label>"
    );

}
