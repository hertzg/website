<?php

function request_contact_params () {

    include_once __DIR__.'/../../../fns/Contacts/request.php';
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $favorite) = Contacts\request();

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($birthday_time) = request_strings('birthday_time');

    if ($birthday_time === '') {
        $birthday_time = null;
    } else {
        $birthday_time = (int)$birthday_time;
        $day = date('j', $birthday_time);
        $month = date('n', $birthday_time);
        $year = date('Y', $birthday_time);
        $birthday_time = mktime(0, 0, 0, $month, $day, $year);
    }

    if ($full_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_FULL_NAME');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$full_name, $alias, $address, $email, $phone1, $phone2,
        $birthday_time, $username, $tags, $tag_names, $favorite];

}
