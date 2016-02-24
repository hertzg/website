<?php

include_once '../fns/require_api_key.php';
require_api_key('schedule/send',
    'can_write_schedules', $apiKey, $user, $mysqli);

$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_schedule');

include_once 'fns/require_schedule_params.php';
require_schedule_params($text, $interval, $offset, $tags, $tag_names);

include_once '../../fns/Users/Schedules/Received/add.php';
Users\Schedules\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $text, $interval, $offset, $tags);

header('Content-Type: application/json');
echo 'true';
