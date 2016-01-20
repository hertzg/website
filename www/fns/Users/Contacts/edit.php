<?php

namespace Users\Contacts;

function edit ($mysqli, $user, $contact, $full_name, $alias,
    $address, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes,
    $favorite, &$changed, $updateApiKey = null) {

    $tags_same = $contact->tags === $tags;

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
        $contact->phone2_label === $phone2_label) {

        if (($contact->birthday_time === null && $birthday_time === null) ||
            (int)$contact->birthday_time === $birthday_time) {

            if ($contact->username === $username) {
                if (($contact->timezone === null && $timezone === null) ||
                    (int)$contact->timezone === $timezone) {

                    if ($tags_same && $contact->notes === $notes &&
                        (bool)$contact->favorite === $favorite) return;

                }
            }

        }

    }

    $changed = true;
    $id = $contact->id;
    $id_users = $contact->id_users;
    $fnsDir = __DIR__.'/../..';

    $update_time = time();

    include_once "$fnsDir/Contacts/edit.php";
    \Contacts\edit($mysqli, $id, $full_name, $alias, $address,
        $email1, $email1_label, $email2, $email2_label,
        $phone1, $phone1_label, $phone2, $phone2_label,
        $birthday_time, $username, $timezone, $tags, $tag_names,
        $notes, $favorite, $update_time, $updateApiKey);

    if ($tags_same) {
        if ($tag_names) {
            include_once "$fnsDir/ContactTags/editContact.php";
            \ContactTags\editContact($mysqli, $id, $full_name,
                $alias, $email1, $email1_label, $email2, $email2_label,
                $phone1, $phone1_label, $phone2, $phone2_label,
                $favorite, $contact->insert_time, $update_time);
        }
    } else {

        if ($contact->num_tags) {
            include_once "$fnsDir/ContactTags/deleteOnContact.php";
            \ContactTags\deleteOnContact($mysqli, $id);
        }

        if ($tag_names) {
            include_once "$fnsDir/ContactTags/add.php";
            \ContactTags\add($mysqli, $id_users, $id,
                $tag_names, $full_name, $alias, $email1,
                $email1_label, $email2, $email2_label,
                $phone1, $phone1_label, $phone2, $phone2_label,
                $favorite, $contact->insert_time, $update_time);
        }

    }

    include_once "$fnsDir/ContactRevisions/add.php";
    \ContactRevisions\add($mysqli, $id,
        $id_users, $full_name, $alias, $address,
        $email1, $email1_label, $email2, $email2_label,
        $phone1, $phone1_label, $phone2, $phone2_label,
        $birthday_time, $username, $timezone, $tags,
        $notes, $favorite, $update_time, $contact->revision + 1);

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
