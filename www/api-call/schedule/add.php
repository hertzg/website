<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_schedules', $apiKey, $user, $mysqli);

include_once 'fns/request_schedule_params.php';
list($text, $interval, $offset, $tags, $tag_names) = request_schedule_params();

include_once '../../fns/Users/Schedules/add.php';
$id = Users\Schedules\add($mysqli, $user, $text,
    $interval, $offset, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo $id;
