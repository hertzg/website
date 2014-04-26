<?php

function request_contact_params ($mysqli, $id_users, $exclude_id = 0) {

    include_once __DIR__.'/../../../fns/Contacts/request.php';
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $favorite) = Contacts\request();

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($birthday_time) = request_strings('birthday_time');

    $birthday_time = (int)$birthday_time;

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
