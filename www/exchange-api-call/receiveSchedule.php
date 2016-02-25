<?php

include_once '../../lib/defaults.php';

include_once 'fns/require_admin_connection.php';
require_admin_connection('receiveSchedule', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_schedule',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_schedule_params.php';
require_schedule_params($text, $interval, $offset, $tags, $tag_names);

include_once '../fns/Users/Schedules/Received/add.php';
Users\Schedules\Received\add($mysqli, null,
    $sender_username, $receiver_user->id_users,
    $text, $interval, $offset, $tags, $sender_address);

header('Content-Type: application/json');
echo 'true';
