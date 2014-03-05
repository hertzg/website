<?php

namespace Page;

function warnings ($errors) {
    $html = '<ul class="warnings">';
    foreach ($errors as $error) {
        $html .= "<li><span class=\"bullet\"></span>$error</li>";
    }
    $html .=
        '</ul>'
        .'<div class="warnings-hr"></div>';
    return $html;
}
