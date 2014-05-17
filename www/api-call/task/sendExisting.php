<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_task.php';
$task = require_task($mysqli, $id_users);

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_task');

include_once '../../fns/Users/Tasks/send.php';
Users\Tasks\send($mysqli, $user, $receiver_user->id_users, $task);

header('Content-Type: application/json');
echo 'true';
