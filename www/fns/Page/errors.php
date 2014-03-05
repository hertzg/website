<?php

namespace Page;

function errors (array $errors) {
    $html = '<ul class="errors">';
    foreach ($errors as $error) {
        $html .= "<li><span class=\"bullet\"></span>$error</li>";
    }
    $html .=
        '</ul>'
        .'<div class="errors-hr"></div>';
    return $html;
}
