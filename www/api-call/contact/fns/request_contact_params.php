<?php

function request_contact_params ($mysqli, $id_users, $exclude_id = 0) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $birthday_time, $username, $favorite) = request_strings(
        'full_name', 'alias', 'address', 'email', 'phone1',
        'phone2', 'birthday_time', 'username', 'favorite');

    include_once __DIR__.'/../../../fns/str_collapse_spaces.php';
    $full_name = str_collapse_spaces($full_name);
    $alias = str_collapse_spaces($alias);
    $address = str_collapse_spaces($address);
    $email = str_collapse_spaces($email);
    $phone1 = str_collapse_spaces($phone1);
    $phone2 = str_collapse_spaces($phone2);
    $username = str_collapse_spaces($username);

    $birthday_time = (int)$birthday_time;
    $favorite = (bool)$favorite;

    if ($full_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_FULL_NAME');
    } elseif (mb_strlen($full_name, 'UTF-8') > 32) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FULL_NAME_TOO_LONG');
    } else {
        include_once __DIR__.'/../../../fns/Contacts/getByFullName.php';
        if (Contacts\getByFullName($mysqli, $id_users, $full_name, $exclude_id)) {
            include_once __DIR__.'/../../fns/bad_request.php';
            bad_request('CONTACT_ALREADY_EXISTS');
        }
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$full_name, $alias, $address, $email, $phone1, $phone2,
        $birthday_time, $username, $tags, $tag_names, $favorite];

}
