<?php

namespace Users\Contacts;

function edit ($mysqli, $user, $contact, $full_name, $alias,
    $address, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes,
    $favorite, &$changed, $updateApiKey = null) {

    $birthday_time_null = $contact->birthday_time === null &&
        $birthday_time === null;
    $birthday_time_same = $birthday_time_null ||
        (int)$contact->birthday_time === $birthday_time;

    $timezone_null = $contact->timezone === null && $timezone === null;
    $timezone_same = $timezone_null || (int)$contact->timezone === $timezone;

    if ($contact->full_name === $full_name &&
        $contact->alias === $alias &&
        $contact->address === $address &&
        $contact->email1 === $email1 &&
        $contact->email1_label === $email1_label &&
        $contact->email2 === $email2 &&
        $contact->email2_label === $email2_label &&
        $contact->phone1 === $phone1 &&
        $contact->phone1_label === $phone1_label &&
        $contact->phone2 === $phone2 &&
        $contact->phone2_label === $phone2_label &&
        $birthday_time_same && $contact->username === $username &&
        $timezone_same && $contact->tags === $tags &&
        $contact->notes === $notes &&
        (bool)$contact->favorite === $favorite) return;

    $changed = true;
    $id = $contact->id;
    $fnsDir = __DIR__.'/../..';

    $update_time = time();

    include_once "$fnsDir/Contacts/edit.php";
    \Contacts\edit($mysqli, $id, $full_name, $alias, $address,
        $email1, $email1_label, $email2, $email2_label,
        $phone1, $phone1_label, $phone2, $phone2_label,
        $birthday_time, $username, $timezone, $tags, $tag_names,
        $notes, $favorite, $update_time, $updateApiKey);

    if ($contact->num_tags) {
        include_once "$fnsDir/ContactTags/deleteOnContact.php";
        \ContactTags\deleteOnContact($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/ContactTags/add.php";
        \ContactTags\add($mysqli, $contact->id_users, $id,
            $tag_names, $full_name, $alias, $email1,
            $email1_label, $email2, $email2_label,
            $phone1, $phone1_label, $phone2, $phone2_label,
            $favorite, $contact->insert_time, $update_time);
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
