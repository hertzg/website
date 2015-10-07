<?php

namespace Form;

function textfieldWithLabel ($name, $text, $config = [], $labelConfig = []) {

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
    return association(
        '<input class="form-textfield" style="width: 70%"'
        .$maxlengthAttribute.$valueAttribute
        ." id=\"$name\" name=\"$name\" type=\"text\" />"
        .'<input class="form-textfield" style="width: 30%" type="text"'
        ." name=\"{$name}_label\" maxlength=\"$labelConfig[maxlength]\""
        ." placeholder=\"$labelConfig[placeholder]\""
        .' value="'.htmlspecialchars($labelConfig['value']).'" />',
        "<label for=\"$name\">$text:</label>"
    );

}
