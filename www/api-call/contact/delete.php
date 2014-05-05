<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_contact.php';
list($id, $contact) = require_contact($mysqli, $id_users);

include_once '../../fns/Contacts/delete.php';
Contacts\delete($mysqli, $id);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/Users/Contacts/addNumber.php';
Users\Contacts\addNumber($mysqli, $id_users, -1);

include_once '../../fns/Users/Birthdays/invalidateIfNeeded.php';
Users\Birthdays\invalidateIfNeeded($mysqli, $user, $contact->birthday_time);

header('Content-Type: application/json');
echo 'true';
