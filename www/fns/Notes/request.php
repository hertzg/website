<?php

namespace Notes;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');

    include_once "$fnsDir/request_strings.php";
    list($tags, $encrypt_in_listings, $password_protect) = request_strings(
        'tags', 'encrypt_in_listings', 'password_protect');

    include_once "$fnsDir/str_collapse_spaces.php";
    $tags = str_collapse_spaces($tags);

    $encrypt_in_listings = (bool)$encrypt_in_listings;
    $password_protect = (bool)$password_protect;

    return [$text, $tags, $encrypt_in_listings, $password_protect];

}
