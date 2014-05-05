<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params();

include_once '../../fns/Users/Tasks/add.php';
$id = Users\Tasks\add($mysqli, $id_users,
    $text, $top_priority, $tags, $tag_names);

header('Content-Type: application/json');
echo $id;
