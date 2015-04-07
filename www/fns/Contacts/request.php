<?php

namespace Contacts;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $timezone, $tags, $favorite) = request_strings(
        'full_name', 'alias', 'address', 'email', 'phone1',
        'phone2', 'username', 'timezone', 'tags', 'favorite');

    include_once "$fnsDir/str_collapse_spaces.php";
    $full_name = str_collapse_spaces($full_name);
    $alias = str_collapse_spaces($alias);
    $address = str_collapse_spaces($address);
    $email = str_collapse_spaces($email);
    $phone1 = str_collapse_spaces($phone1);
    $phone2 = str_collapse_spaces($phone2);
    $username = str_collapse_spaces($username);
    $tags = str_collapse_spaces($tags);

    if ($timezone === '') $timezone = null;
    else {
        include_once "$fnsDir/Timezone/isValid.php";
        if (!\Timezone\isValid($timezone)) $timezone = null;
    }

    include_once "$fnsDir/request_text.php";
    $notes = request_text('notes');

    $favorite = (bool)$favorite;

    return [$full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $timezone, $tags, $notes, $favorite];

}
