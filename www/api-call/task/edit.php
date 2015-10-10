<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_tasks');

include_once 'fns/require_task.php';
$task = require_task($mysqli, $user);

include_once 'fns/request_task_params.php';
list($text, $deadline_time, $tags,
    $tag_names, $top_priority) = request_task_params($user);

include_once '../../fns/Users/Tasks/edit.php';
Users\Tasks\edit($mysqli, $user, $task, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
