<?php

include_once '../fns/require_api_key.php';
require_api_key('contact/send', 'can_write_contacts', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_contact');

include_once 'fns/require_contact_params.php';
require_contact_params($receiver_user, $full_name, $alias,
    $address, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes, $favorite);

include_once '../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $full_name, $alias, $address,
    $email1, $email1_label, $email2, $email2_label, $phone1,
    $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $notes, $favorite, null);

header('Content-Type: application/json');
echo 'true';
