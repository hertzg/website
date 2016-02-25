<?php

include_once '../../lib/defaults.php';

include_once 'fns/require_admin_connection.php';
require_admin_connection('receiveTask', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_task',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_task_params.php';
require_task_params($receiver_user, $text,
    $deadline_time, $tags, $tag_names, $top_priority);

include_once '../fns/Users/Tasks/Received/add.php';
Users\Tasks\Received\add($mysqli, null,
    $sender_username, $receiver_user->id_users, $text,
    $deadline_time, $tags, $top_priority, $sender_address);

header('Content-Type: application/json');
echo 'true';
