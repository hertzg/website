<?php

namespace Notes;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($text, $encrypt) = request_strings('text', 'encrypt');

    include_once __DIR__.'/../str_collapse_spaces_multiline.php';
    $text = str_collapse_spaces_multiline($text);
    $text = trim($text);

    $encrypt = (bool)$encrypt;

    return [$text, $encrypt];

}
