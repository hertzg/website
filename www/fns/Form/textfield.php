<?php

namespace Form;

function textfield ($name, $text, $config = []) {

    if (array_key_exists('type', $config)) {
        $type = $config['type'];
    } else {
        $type = 'text';
    }

    if (array_key_exists('value', $config)) {
        $valueAttribute = ' value="'.htmlspecialchars($config['value']).'"';
    } else {
        $valueAttribute = '';
    }

    if (array_key_exists('maxlength', $config)) {
        $maxlengthAttribute = " maxlength=\"$config[maxlength]\"";
    } else {
        $maxlengthAttribute = '';
    }

    include_once __DIR__.'/association.php';
    include_once __DIR__.'/getBoolAttribute.php';
    return association(
        '<input class="form-textfield"'
        .$maxlengthAttribute.$valueAttribute
        .getBoolAttribute('autofocus', $config)
        .getBoolAttribute('readonly', $config)
        .getBoolAttribute('required', $config)
        ." id=\"$name\" name=\"$name\" type=\"$type\" />",
        "<label class=\"form-property-label\" for=\"$name\">$text:</label>"
    );

}
