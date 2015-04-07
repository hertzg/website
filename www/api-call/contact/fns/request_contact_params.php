<?php

function request_contact_params ($user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Contacts/request.php";
    list($full_name, $alias, $address, $email,
        $phone1, $phone2, $birthday_time, $username,
        $timezone, $tags, $notes, $favorite) = Contacts\request();

    if ($birthday_time !== null) {

        include_once "$fnsDir/daytime.php";
        $birthday_time = daytime($birthday_time);

        include_once "$fnsDir/user_time_today.php";
        $birthday_time = min($birthday_time, user_time_today($user));

    }

    if ($full_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_FULL_NAME');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$full_name, $alias, $address, $email, $phone1,
        $phone2, $birthday_time, $username, $timezone,
        $tags, $tag_names, $notes, $favorite];

}
