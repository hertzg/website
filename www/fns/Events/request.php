<?php

namespace Events;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($text) = request_strings('text');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $text = str_collapse_spaces($text);

    return $text;

}
