<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_task.php';
list($id, $task) = require_task($mysqli, $id_users);

include_once 'fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params();

include_once '../../fns/Tasks/edit.php';
Tasks\edit($mysqli, $id_users, $id, $text, $tags, $top_priority);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $id_users, $id, $tag_names, $text, $top_priority, $tags);

header('Content-Type: application/json');
echo 'true';
