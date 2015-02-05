<?php

namespace Users\Contacts;

function edit ($mysqli, $user, $contact, $full_name, $alias,
    $address, $email, $phone1, $phone2, $birthday_time, $username,
    $timezone, $tags, $tag_names, $notes, $favorite, $updateApiKey = null) {

    $id = $contact->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/edit.php";
    \Contacts\edit($mysqli, $id, $full_name, $alias, $address,
        $email, $phone1, $phone2, $birthday_time, $username, $timezone,
        $tags, $tag_names, $notes, $favorite, $updateApiKey);

    if ($contact->num_tags) {
        include_once "$fnsDir/ContactTags/deleteOnContact.php";
        \ContactTags\deleteOnContact($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/ContactTags/add.php";
        \ContactTags\add($mysqli, $contact->id_users, $id, $tag_names,
            $full_name, $alias, $email, $phone1, $phone2, $favorite);
    }

    if ($contact->birthday_time !== null) {
        include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
        \Users\Birthdays\invalidateIfNeeded(
            $mysqli, $user, $contact->birthday_time);
    }
    if ($birthday_time !== null) {
        include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
        \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);
    }

}
