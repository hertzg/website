<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_tasks');
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_task');

include_once 'fns/request_task_params.php';
list($text, $deadline_time, $tags,
    $tag_names, $top_priority) = request_task_params($user);

include_once '../../fns/Users/Tasks/Received/add.php';
Users\Tasks\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $text, $deadline_time, $tags, $top_priority);

header('Content-Type: application/json');
echo 'true';
