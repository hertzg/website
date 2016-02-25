<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('schedule/sendExisting',
    'can_write_schedules', $apiKey, $user, $mysqli);

$id_users = $user->id_users;

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_schedule');

include_once '../../fns/Users/Schedules/send.php';
Users\Schedules\send($mysqli, $user, $receiver_user->id_users, $schedule);

header('Content-Type: application/json');
echo 'true';
