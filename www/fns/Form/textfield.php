<?php

namespace Form;

function textfield ($name, $text, $options = []) {

    if (array_key_exists('type', $options)) {
        $type = $options['type'];
    } else {
        $type = 'text';
    }

    if (array_key_exists('value', $options)) {
        $valueAttribute = ' value="'.htmlspecialchars($options['value']).'"';
    } else {
        $valueAttribute = '';
    }

    if (array_key_exists('maxlength', $options)) {
        $maxlengthAttribute = " maxlength=\"$options[maxlength]\"";
    } else {
        $maxlengthAttribute = '';
    }

    include_once __DIR__.'/association.php';
    include_once __DIR__.'/getBoolAttribute.php';
    return association(
        '<input class="form-textfield"'
        .$maxlengthAttribute.$valueAttribute
        .getBoolAttribute('autofocus', $options)
        .getBoolAttribute('readonly', $options)
        .getBoolAttribute('required', $options)
        ." id=\"$name\" name=\"$name\" type=\"$type\" />",
        "<label class=\"form-property-label\" for=\"$name\">$text:</label>"
    );

}
