<?php

namespace Notes;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');

    include_once "$fnsDir/request_strings.php";
    list($encrypt) = request_strings('encrypt');
    $encrypt = (bool)$encrypt;

    return [$text, $encrypt];

}
