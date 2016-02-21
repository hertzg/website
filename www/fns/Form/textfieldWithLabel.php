<?php

namespace Form;

function textfieldWithLabel ($name, $text, $options = [], $labelOptions = []) {

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
    return association(
        '<input class="form-textfield withLabel"'
        .$maxlengthAttribute.$valueAttribute
        ." id=\"$name\" name=\"$name\" type=\"text\" />"
        .'<div class="form-textfield-label form-component">'
            .'<div class="form-component-separator"></div>'
            .'<div class="form-component-content">'
                .'<input class="form-textfield"'
                ." placeholder=\"$labelOptions[placeholder]\""
                ." type=\"text\" name=\"{$name}_label\""
                ." maxlength=\"$labelOptions[maxlength]\""
                .' value="'.htmlspecialchars($labelOptions['value']).'" />'
            .'</div>'
        .'</div>',
        "<label class=\"form-property-label\" for=\"$name\">$text:</label>"
    );

}
