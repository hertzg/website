<?php

include_once '../fns/require_api_key.php';
require_api_key('task/sendExisting',
    'can_write_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_task.php';
$task = require_task($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $user->id_users, 'can_send_task');

include_once '../../fns/Users/Tasks/send.php';
Users\Tasks\send($mysqli, $user, $receiver_user->id_users, $task);

header('Content-Type: application/json');
echo 'true';
