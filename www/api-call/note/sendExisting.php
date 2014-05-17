<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_note.php';
$note = require_note($mysqli, $id_users);

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_note');

include_once '../../fns/Users/Notes/Received/add.php';
Users\Notes\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $note->text, $note->tags);

header('Content-Type: application/json');
echo 'true';
