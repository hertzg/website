<?php

include_once '../fns/require_api_key.php';
require_api_key('contact/sendExisting',
    'can_write_contacts', $apiKey, $user, $mysqli);

include_once 'fns/require_contact.php';
$contact = require_contact($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_contact');

include_once '../../fns/Users/Contacts/send.php';
Users\Contacts\send($mysqli, $user, $receiver_user->id_users, $contact);

header('Content-Type: application/json');
echo 'true';
