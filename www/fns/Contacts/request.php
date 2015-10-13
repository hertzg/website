<?php

namespace Contacts;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($alias, $address, $email1_label, $email2_label, $phone1,
        $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $favorite) = request_strings(
        'alias', 'address', 'email1_label', 'email2_label', 'phone1',
        'phone1_label', 'phone2', 'phone2_label', 'birthday_time',
        'username', 'timezone', 'tags', 'favorite');

    include_once "$fnsDir/FullName/request.php";
    $full_name = \FullName\request();

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/Email/maxLength.php";
    $emailMaxLength = \Email\maxLength();

    $alias = str_collapse_spaces($alias);
    $alias = mb_substr($alias, 0, $maxLengths['alias'], 'UTF-8');

    $address = str_collapse_spaces($address);
    $address = mb_substr($address, 0, $maxLengths['address'], 'UTF-8');

    include_once "$fnsDir/Email/request.php";
    $email1 = \Email\request('email1');

    $email1_label = str_collapse_spaces($email1_label);
    $email1_label = mb_substr($email1_label, 0,
        $maxLengths['email1_label'], 'UTF-8');

    $email2 = \Email\request('email2');

    $email2_label = str_collapse_spaces($email2_label);
    $email2_label = mb_substr($email2_label, 0,
        $maxLengths['email2_label'], 'UTF-8');

    $phone1 = str_collapse_spaces($phone1);
    $phone1 = mb_substr($phone1, 0, $maxLengths['phone1'], 'UTF-8');

    $phone1_label = str_collapse_spaces($phone1_label);
    $phone1_label = mb_substr($phone1_label, 0,
        $maxLengths['phone1_label'], 'UTF-8');

    $phone2 = str_collapse_spaces($phone2);
    $phone2 = mb_substr($phone2, 0, $maxLengths['phone2'], 'UTF-8');

    $phone2_label = str_collapse_spaces($phone2_label);
    $phone2_label = mb_substr($phone2_label, 0,
        $maxLengths['phone2_label'], 'UTF-8');

    if ($birthday_time === '') $birthday_time = null;

    $username = str_collapse_spaces($username);
    $username = mb_substr($username, 0, $maxLengths['username'], 'UTF-8');

    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    if ($timezone === '') $timezone = null;
    else {
        $timezone = (int)$timezone;
        include_once "$fnsDir/Timezone/isValid.php";
        if (!\Timezone\isValid($timezone)) $timezone = null;
    }

    include_once "$fnsDir/request_text.php";
    $notes = request_text('notes');
    $notes = mb_substr($notes, 0, $maxLengths['notes'], 'UTF-8');

    $favorite = (bool)$favorite;

    return [$full_name, $alias, $address, $email1, $email1_label,
        $email2, $email2_label, $phone1, $phone1_label, $phone2, $phone2_label,
        $birthday_time, $username, $timezone, $tags, $notes, $favorite];

}
