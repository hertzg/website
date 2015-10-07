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
        '<input class="form-textfield withLabel"'
        .$maxlengthAttribute.$valueAttribute
        ." id=\"$name\" name=\"$name\" type=\"text\" />"
        .'<div class="form-textfield-label">'
            .'<div class="form-textfield-label-separator"></div>'
            .'<div class="form-textfield-label-input">'
                .'<input class="form-textfield" type="text"'
                ." placeholder=\"$labelConfig[placeholder]\""
                ." name=\"{$name}_label\" maxlength=\"$labelConfig[maxlength]\""
                .' value="'.htmlspecialchars($labelConfig['value']).'" />'
            .'</div>'
        .'</div>',
        "<label for=\"$name\">$text:</label>"
    );

}
