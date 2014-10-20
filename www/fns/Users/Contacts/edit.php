<?php

namespace Users\Contacts;

function edit ($mysqli, $user, $contact, $full_name,
    $alias, $address, $email, $phone1, $phone2, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes, $favorite) {

    $id = $contact->id_contacts;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/edit.php";
    \Contacts\edit($mysqli, $id, $full_name, $alias,
        $address, $email, $phone1, $phone2, $birthday_time,
        $username, $timezone, $tags, $tag_names, $notes, $favorite);

    if ($contact->num_tags) {
        include_once "$fnsDir/ContactTags/deleteOnContact.php";
        \ContactTags\deleteOnContact($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/ContactTags/add.php";
        \ContactTags\add($mysqli, $contact->id_users, $id, $tag_names,
            $full_name, $alias, $phone1, $phone2, $favorite);
    }

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded(
        $mysqli, $user, $contact->birthday_time);
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

}
