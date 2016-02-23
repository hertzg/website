<?php

include_once 'fns/require_admin_connection.php';
require_admin_connection('receivePlace', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_place',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_place_params.php';
require_place_params($latitude, $longitude,
    $altitude, $name, $description, $tags, $tag_names);

include_once '../fns/Users/Places/Received/add.php';
Users\Places\Received\add($mysqli, null, $sender_username,
    $receiver_user->id_users, $latitude, $longitude,
    $altitude, $name, $description, $tags, $sender_address);

header('Content-Type: application/json');
echo 'true';
