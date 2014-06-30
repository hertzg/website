<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once '../fns/request_receiver_user.php';
$receiver_user = request_receiver_user($mysqli, $id_users, 'can_send_task');

include_once 'fns/request_task_params.php';
$values = request_task_params();
list($text, $deadline_time, $tags, $tag_names, $top_priority) = $values;

include_once '../../fns/Users/Tasks/Received/add.php';
Users\Tasks\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $text, $deadline_time, $tags, $top_priority);

header('Content-Type: application/json');
echo 'true';
