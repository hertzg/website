<?php

include_once '../fns/require_api_key.php';
require_api_key('note/sendExisting',
    'can_write_notes', $apiKey, $user, $mysqli);

include_once 'fns/require_note.php';
$note = require_note($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_note');

include_once '../../fns/Users/Notes/send.php';
Users\Notes\send($mysqli, $user, $receiver_user->id_users, $note);

header('Content-Type: application/json');
echo 'true';
