<?php

include_once '../fns/require_api_key.php';
require_api_key('note/send', 'can_write_notes', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_note');

include_once 'fns/require_note_params.php';
require_note_params($text, $tags, $tag_names,
    $encrypt_in_listings, $password_protect, $encryption_key);

include_once '../../fns/Users/Notes/Received/add.php';
Users\Notes\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $text, $tags, $encrypt_in_listings);

header('Content-Type: application/json');
echo 'true';
