<?php

namespace Users\Contacts;

function add ($mysqli, $user, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username,
    $timezone, $tags, $tag_names, $favorite, $photo_id) {

    $id_users = $user->id_users;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/add.php";
    $id = \Contacts\add($mysqli, $id_users, $full_name, $alias,
        $address, $email, $phone1, $phone2, $birthday_time,
        $username, $timezone, $tags, $favorite, $photo_id);

    include_once "$fnsDir/ContactTags/add.php";
    \ContactTags\add($mysqli, $id_users, $id, $tag_names,
        $full_name, $alias, $phone1, $phone2, $favorite);

    if ($photo_id) {
        include_once "$fnsDir/ContactPhotos/addRef.php";
        \ContactPhotos\addRef($mysqli, $photo_id);
    }

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
