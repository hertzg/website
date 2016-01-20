<?php

namespace Users\Contacts;

function add ($mysqli, $user, $full_name, $alias, $address,
    $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label,
    $birthday_time, $username, $timezone, $tags, $tag_names,
    $notes, $favorite, $photo_id, $insertApiKey = null) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    $insert_time = $update_time = time();

    include_once "$fnsDir/Contacts/add.php";
    $id = \Contacts\add($mysqli, $id_users,
        $full_name, $alias, $address, $email1, $email1_label,
        $email2, $email2_label, $phone1, $phone1_label,
        $phone2, $phone2_label, $birthday_time, $username,
        $timezone, $tags, $tag_names, $notes, $favorite, $photo_id,
        $insert_time, $update_time, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/ContactTags/add.php";
        \ContactTags\add($mysqli, $id_users, $id, $tag_names,
            $full_name, $alias, $email1, $email1_label, $email2,
            $email2_label, $phone1, $phone1_label, $phone2,
            $phone2_label, $favorite, $insert_time, $update_time);
    }

    if ($photo_id) {
        include_once "$fnsDir/ContactPhotos/addRef.php";
        \ContactPhotos\addRef($mysqli, $photo_id);
    }

    if ($birthday_time !== null) {
        include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
        \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once "$fnsDir/ContactRevisions/add.php";
    \ContactRevisions\add($mysqli, $id, $id_users,
        $full_name, $alias, $address, $email1, $email1_label,
        $email2, $email2_label, $phone1, $phone1_label,
        $phone2, $phone2_label, $birthday_time, $username,
        $timezone, $tags, $notes, $favorite, $insert_time, 0);

    return $id;

}
