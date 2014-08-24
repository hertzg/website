<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_tasks');
$id_users = $user->id_users;

include_once 'fns/require_task.php';
$task = require_task($mysqli, $id_users);

include_once 'fns/request_task_params.php';
$values = request_task_params();
list($text, $deadline_time, $tags, $tag_names, $top_priority) = $values;

include_once '../../fns/Users/Tasks/edit.php';
Users\Tasks\edit($mysqli, $id_users, $task->id_tasks,
    $text, $deadline_time, $tags, $tag_names, $top_priority);

header('Content-Type: application/json');
echo 'true';
