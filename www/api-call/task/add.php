<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_tasks', $apiKey, $user, $mysqli);

include_once 'fns/request_task_params.php';
list($text, $deadline_time, $tags,
    $tag_names, $top_priority) = request_task_params($user);

include_once '../../fns/Users/Tasks/add.php';
$id = Users\Tasks\add($mysqli, $user, $text,
    $deadline_time, $tags, $tag_names, $top_priority, $apiKey);

header('Content-Type: application/json');
echo $id;
