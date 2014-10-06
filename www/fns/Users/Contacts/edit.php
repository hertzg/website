<?php

namespace Users\Contacts;

function edit ($mysqli, $user, $id, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $timezone, $tags, $tag_names,
    $notes, $favorite, $old_birthday_time) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/edit.php";
    \Contacts\edit($mysqli, $id_users, $id, $full_name, $alias,
        $address, $email, $phone1, $phone2, $birthday_time,
        $username, $timezone, $tags, $tag_names, $notes, $favorite);

    include_once "$fnsDir/ContactTags/deleteOnContact.php";
    \ContactTags\deleteOnContact($mysqli, $id);

    include_once "$fnsDir/ContactTags/add.php";
    \ContactTags\add($mysqli, $id_users, $id, $tag_names,
        $full_name, $alias, $phone1, $phone2, $favorite);

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $old_birthday_time);
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

}
