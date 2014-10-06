<?php

function request_contact_params ($user) {

    include_once __DIR__.'/../../../fns/Contacts/request.php';
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $timezone, $notes, $favorite) = Contacts\request();

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($birthday_time) = request_strings('birthday_time');

    if ($birthday_time === '') {
        $birthday_time = null;
    } else {
        include_once __DIR__.'/../../../fns/daytime.php';
        $birthday_time = daytime($birthday_time);
        include_once __DIR__.'/../../../fns/user_time_today.php';
        $birthday_time = min($birthday_time, user_time_today($user));
    }

    if ($full_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_FULL_NAME');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$full_name, $alias, $address, $email, $phone1, $phone2,
        $birthday_time, $username, $timezone, $tags, $tag_names, $favorite];

}
