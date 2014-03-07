<?php

namespace Form;

function textarea ($name, $text, $config = array()) {

    if (array_key_exists('value', $config)) {
        $content = "\n".htmlspecialchars($config['value']);
    } else{
        $content = '';
    }

    include_once __DIR__.'/association.php';
    include_once __DIR__.'/getBoolAttribute.php';

    return association(
        '<textarea class="form-textarea"'
        .getBoolAttribute('autofocus', $config)
        .getBoolAttribute('readonly', $config)
        .getBoolAttribute('required', $config)
        ." id=\"$name\" name=\"$name\">$content</textarea>",
        "<label for=\"$name\">$text:</label>"
    );

}
