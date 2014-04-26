<?php

namespace Contacts;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $favorite) = request_strings(
        'full_name', 'alias', 'address', 'email', 'phone1',
        'phone2', 'username', 'favorite');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $full_name = str_collapse_spaces($full_name);
    $alias = str_collapse_spaces($alias);
    $address = str_collapse_spaces($address);
    $email = str_collapse_spaces($email);
    $phone1 = str_collapse_spaces($phone1);
    $phone2 = str_collapse_spaces($phone2);
    $username = str_collapse_spaces($username);

    $favorite = (bool)$favorite;

    return [$full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $favorite];

}
