<?php

function request_text ($name) {

    include_once __DIR__.'/request_strings.php';
    list($text) = request_strings($name);

    include_once __DIR__.'/str_collapse_spaces_multiline.php';
    $text = str_collapse_spaces_multiline($text);

    include_once __DIR__.'/str_collapse_lines.php';
    $text = str_collapse_lines($text);

    return $text;

}
