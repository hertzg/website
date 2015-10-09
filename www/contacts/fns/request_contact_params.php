<?php

function request_contact_params ($user, &$errors) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Contacts/request.php";
    list($full_name, $alias, $address, $email1,
        $email1_label, $email2, $email2_label, $phone1,
        $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $notes, $favorite) = Contacts\request();

    include_once "$fnsDir/request_strings.php";
    list($birthday_day, $birthday_month, $birthday_year) = request_strings(
        'birthday_day', 'birthday_month', 'birthday_year');

    $birthday_day = abs((int)$birthday_day);
    $birthday_month = abs((int)$birthday_month);
    $birthday_year = abs((int)$birthday_year);

    if ($full_name === '') $errors[] = 'Enter full name.';

    include_once __DIR__.'/../fns/parse_birthday.php';
    parse_birthday($birthday_day, $birthday_month,
        $birthday_year, $user, $errors, $birthday_time);

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors);

    return [$full_name, $alias, $address, $email1,
        $email1_label, $email2, $email2_label, $phone1,
        $phone1_label, $phone2, $phone2_label, $birthday_day,
        $birthday_month, $birthday_year, $birthday_time, $username,
        $timezone, $tags, $tag_names, $notes, $favorite];

}
