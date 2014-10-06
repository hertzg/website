<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_contacts');
$id_users = $user->id_users;

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_contact');

include_once 'fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1, $phone2,
    $birthday_time, $username, $timezone, $tags, $tag_names,
    $notes, $favorite) = request_contact_params($user);

include_once '../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $full_name, $alias, $address, $email, $phone1,
    $phone2, $birthday_time, $username, $timezone, $tags, $favorite, null);

header('Content-Type: application/json');
echo 'true';
