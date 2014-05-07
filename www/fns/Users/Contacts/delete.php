<?php

namespace Users\Contacts;

function delete ($mysqli, $contact, $user) {

    $id = $contact->id_contacts;

    include_once __DIR__.'/../../Contacts/delete.php';
    \Contacts\delete($mysqli, $id);

    include_once __DIR__.'/../../ContactTags/deleteOnContact.php';
    \ContactTags\deleteOnContact($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once __DIR__.'/../Birthdays/invalidateIfNeeded.php';
    \Users\Birthdays\invalidateIfNeeded($mysqli, $user, $contact->birthday_time);

}
