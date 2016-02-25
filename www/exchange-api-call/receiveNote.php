<?php

include_once '../../lib/defaults.php';

include_once 'fns/require_admin_connection.php';
require_admin_connection('receiveNote', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_note',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_note_params.php';
require_note_params($text, $tags, $tag_names, $encrypt_in_listings);

include_once '../fns/Users/Notes/Received/add.php';
Users\Notes\Received\add($mysqli, null,
    $sender_username, $receiver_user->id_users, $text,
    $tags, $encrypt_in_listings, $sender_address);

header('Content-Type: application/json');
echo 'true';
