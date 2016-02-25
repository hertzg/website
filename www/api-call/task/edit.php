<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('task/edit', 'can_write_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_task.php';
$task = require_task($mysqli, $user);

include_once 'fns/require_task_params.php';
require_task_params($user, $text,
    $deadline_time, $tags, $tag_names, $top_priority);

include_once '../../fns/Users/Tasks/edit.php';
Users\Tasks\edit($mysqli, $user, $task, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
