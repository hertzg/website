<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_schedules');

include_once 'fns/request_schedule_params.php';
list($text, $interval, $offset, $tags, $tag_names) = request_schedule_params();

include_once '../../fns/Users/Schedules/add.php';
$id = Users\Schedules\add($mysqli, $user,
    $text, $interval, $offset, $tags, $tag_names);

header('Content-Type: application/json');
echo $id;
