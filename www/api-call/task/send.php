<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('task/send', 'can_write_tasks', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_task');

include_once 'fns/require_task_params.php';
require_task_params($receiver_user, $text,
    $deadline_time, $tags, $tag_names, $top_priority);

include_once '../../fns/Users/Tasks/Received/add.php';
Users\Tasks\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $text, $deadline_time, $tags, $top_priority);

header('Content-Type: application/json');
echo 'true';
