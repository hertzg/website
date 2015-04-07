<?php

namespace Notes;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');

    include_once "$fnsDir/request_strings.php";
    list($tags, $encrypt) = request_strings('tags', 'encrypt');

    include_once "$fnsDir/str_collapse_spaces.php";
    $tags = str_collapse_spaces($tags);

    $encrypt = (bool)$encrypt;

    return [$text, $tags, $encrypt];

}
