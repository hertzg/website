<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');
$id_users = $user->id_users;

include_once 'fns/require_note.php';
$note = require_note($mysqli, $id_users);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_note');

include_once '../../fns/Users/Notes/send.php';
Users\Notes\send($mysqli, $user, $receiver_user->id_users, $note);

header('Content-Type: application/json');
echo 'true';
