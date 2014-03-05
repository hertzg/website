<?php

namespace Page;

function messages (array $messages) {
    $html = '<ul class="messages">';
    foreach ($messages as $message) {
        $html .= "<li><span class=\"bullet\"></span>$message</li>";
    }
    $html .=
        '</ul>'
        .'<div class="messages-hr"></div>';
    return $html;
}
