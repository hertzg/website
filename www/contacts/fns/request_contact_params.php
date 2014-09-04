<?php

function request_contact_params (&$errors) {

    include_once __DIR__.'/../../fns/Contacts/request.php';
    list($full_name, $alias, $address, $email, $phone1,
        $phone2, $username, $timezone, $favorite) = Contacts\request();

    include_once __DIR__.'/../../fns/request_strings.php';
    list($birthday_day, $birthday_month, $birthday_year) = request_strings(
        'birthday_day', 'birthday_month', 'birthday_year');

    $birthday_day = abs((int)$birthday_day);
    $birthday_month = abs((int)$birthday_month);
    $birthday_year = abs((int)$birthday_year);

    if ($full_name === '') $errors[] = 'Enter full name.';

    include_once __DIR__.'/../fns/parse_birthday.php';
    parse_birthday($birthday_day, $birthday_month,
        $birthday_year, $errors, $birthday_time);

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    return [$full_name, $alias, $address, $email, $phone1, $phone2,
        $birthday_day, $birthday_month, $birthday_year, $birthday_time,
        $username, $timezone, $tags, $tag_names, $favorite];

}
