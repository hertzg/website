<?php

namespace Form;

function label ($text, $value) {
    include_once __DIR__.'/association.php';
    return association("<div class=\"form-label\">$value</div>", "$text:");
}
