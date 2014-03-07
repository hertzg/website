<?php

namespace Form;

function filefield ($name, $text) {
    include_once __DIR__.'/../../classes/Form.php';
    return \Form::association(
        '<input class="form-filefield" type="file" multiple="multiple"'
        ." id=\"$name\" name=\"$name\" />",
        "<label for=\"$name\">$text</label>"
    );
}
