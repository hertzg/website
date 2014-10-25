<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_notes');
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_note');

include_once 'fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt) = request_note_params();

include_once '../../fns/Users/Notes/Received/add.php';
Users\Notes\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $text, $tags, $encrypt);

header('Content-Type: application/json');
echo 'true';
