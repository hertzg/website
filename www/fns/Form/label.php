<?php

namespace Form;

function label ($text, $value) {
    include_once __DIR__.'/../../classes/Form.php';
    return \Form::association(
        "<div class=\"form-label\">$value</div>",
        "<label>$text:</label>"
    );
}
