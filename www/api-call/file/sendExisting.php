<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_files');
$id_users = $user->id_users;

include_once 'fns/require_file.php';
$file = require_file($mysqli, $id_users);

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_file');

include_once '../../fns/Users/Files/send.php';
Users\Files\send($mysqli, $user, $receiver_user->id_users, $file);

header('Content-Type: application/json');
echo 'true';
