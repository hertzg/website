<?php

namespace Form;

function textarea ($name, $text, $config = []) {

    if (array_key_exists('value', $config)) {
        $content = "\n".htmlspecialchars($config['value']);
    } else{
        $content = '';
    }

    if (array_key_exists('maxlength', $config)) {
        $maxlengthAttribute = " maxlength=\"$config[maxlength]\"";
    } else {
        $maxlengthAttribute = '';
    }

    include_once __DIR__.'/association.php';
    include_once __DIR__.'/getBoolAttribute.php';

    return association(
        '<textarea class="form-textarea"'
        .$maxlengthAttribute
        .getBoolAttribute('autofocus', $config)
        .getBoolAttribute('readonly', $config)
        .getBoolAttribute('required', $config)
        ." id=\"$name\" name=\"$name\">$content</textarea>",
        "<label class=\"form-property-label\" for=\"$name\">$text:</label>"
    );

}
