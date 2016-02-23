<?php

include_once 'fns/require_admin_connection.php';
require_admin_connection('receiveContact', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_contact',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_contact_params.php';
require_contact_params($receiver_user, $full_name, $alias,
    $address, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes, $favorite);

include_once '../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, null, $sender_username,
    $receiver_user->id_users, $full_name, $alias, $address,
    $email1, $email1_label, $email2, $email2_label, $phone1,
    $phone1_label, $phone2, $phone2_label, $birthday_time, $username,
    $timezone, $tags, $notes, $favorite, null, $sender_address);

header('Content-Type: application/json');
echo 'true';
