<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_task.php';
list($id, $task) = require_task($mysqli, $id_users);

include_once '../../fns/Users/Tasks/delete.php';
Users\Tasks\delete($mysqli, $task);

header('Content-Type: application/json');
echo 'true';
