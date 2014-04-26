<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_task.php';
list($id, $task) = require_task($mysqli, $id_users);

include_once '../../fns/Tasks/delete.php';
Tasks\delete($mysqli, $id);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/Users/addNumTasks.php';
Users\addNumTasks($mysqli, $id_users, -1);

header('Content-Type: application/json');
echo 'true';
