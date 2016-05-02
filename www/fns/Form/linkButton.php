<?php

namespace Form;

function linkButton ($text, $href, $default) {
    $class = $default ? 'green' : 'not_green';
    return
        "<div class=\"form-button $class\">"
            ."<a href=\"$href\" class=\"form-button-button $class\">$text</a>"
        .'</div>';
}
