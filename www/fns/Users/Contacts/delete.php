<?php

namespace Users\Contacts;

function delete ($mysqli, $contact, $user) {

    $id = $contact->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Contacts/delete.php";
    \Contacts\delete($mysqli, $id);

    if ($contact->num_tags) {
        include_once "$fnsDir/ContactTags/deleteOnContact.php";
        \ContactTags\deleteOnContact($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once __DIR__.'/../DeletedItems/addContact.php';
    \Users\DeletedItems\addContact($mysqli, $contact);

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded(
        $mysqli, $user, $contact->birthday_time);

}
