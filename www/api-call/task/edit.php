<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_task.php';
list($id, $task) = require_task($mysqli, $id_users);

include_once 'fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params();

include_once '../../fns/Users/Tasks/edit.php';
Users\Tasks\edit($mysqli, $id_users, $id,
    $text, $tags, $tag_names, $top_priority);

header('Content-Type: application/json');
echo 'true';
