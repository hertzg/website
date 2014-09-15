<?php

namespace Notes;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($text, $encrypt) = request_strings('text', 'encrypt');

    include_once "$fnsDir/str_collapse_spaces_multiline.php";
    $text = str_collapse_spaces_multiline($text);
    $text = trim($text);

    $encrypt = (bool)$encrypt;

    return [$text, $encrypt];

}
