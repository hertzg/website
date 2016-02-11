<?php

function require_contact_params ($user, &$full_name, &$alias,
    &$address, &$email1, &$email1_label, &$email2, &$email2_label,
    &$phone1, &$phone1_label, &$phone2, &$phone2_label, &$birthday_time,
    &$username, &$timezone, &$tags, &$tag_names, &$notes, &$favorite) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Contacts/request.php";
    list($full_name, $alias, $address, $email1,
        $email1_label, $email2, $email2_label, $phone1,
        $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $notes, $favorite) = Contacts\request();

    if ($birthday_time !== null) {

        include_once "$fnsDir/daytime.php";
        $birthday_time = daytime($birthday_time);

        include_once "$fnsDir/user_time_today.php";
        $birthday_time = min($birthday_time, user_time_today($user));

    }

    if ($full_name === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_FULL_NAME"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
