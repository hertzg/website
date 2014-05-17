<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $id_users);

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_contact');

include_once '../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $contact->full_name, $contact->alias,
    $contact->address, $contact->email, $contact->phone1, $contact->phone2,
    $contact->birthday_time, $contact->username, $contact->tags,
    $contact->favorite);

header('Content-Type: application/json');
echo 'true';
