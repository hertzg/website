<?php

namespace Notes;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($tags, $encrypt_in_listings, $password_protect) = request_strings(
        'tags', 'encrypt_in_listings', 'password_protect');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');
    $text = mb_substr($text, 0, $maxLengths['text'], 'UTF-8');

    include_once "$fnsDir/str_collapse_spaces.php";
    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    $encrypt_in_listings = (bool)$encrypt_in_listings;
    $password_protect = (bool)$password_protect;

    return [$text, $tags, $encrypt_in_listings, $password_protect];

}
