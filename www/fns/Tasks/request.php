<?php

namespace Tasks;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($text, $top_priority) = request_strings('text', 'top_priority');

    include_once __DIR__.'/../str_collapse_spaces_multiline.php';
    $text = str_collapse_spaces_multiline($text);
    $text = trim($text);

    $top_priority = (bool)$top_priority;

    return [$text, $top_priority];

}
