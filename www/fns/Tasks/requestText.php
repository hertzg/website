<?php

namespace Tasks;

function requestText () {

    include_once __DIR__.'/../request_strings.php';
    list($text) = request_strings('text');

    include_once __DIR__.'/../str_collapse_spaces_multiline.php';
    $text = str_collapse_spaces_multiline($text);

    $text = trim($text);

    return $text;

}
