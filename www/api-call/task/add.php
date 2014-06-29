<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params();

include_once '../../fns/Users/Tasks/add.php';
$id = Users\Tasks\add($mysqli, $user->id_users,
    $text, $tags, $tag_names, $top_priority);

header('Content-Type: application/json');
echo $id;
