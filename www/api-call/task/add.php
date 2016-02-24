<?php

include_once '../fns/require_api_key.php';
require_api_key('task/add', 'can_write_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_task_params.php';
require_task_params($user, $text,
    $deadline_time, $tags, $tag_names, $top_priority);

include_once '../../fns/Users/Tasks/add.php';
$id = Users\Tasks\add($mysqli, $user, $text,
    $deadline_time, $tags, $tag_names, $top_priority, $apiKey);

header('Content-Type: application/json');
echo $id;
