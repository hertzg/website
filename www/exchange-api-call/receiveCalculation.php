<?php

include_once 'fns/require_admin_connection.php';
require_admin_connection('receiveCalculation', $adminConnection, $mysqli);

$sender_address = $adminConnection->address;

include_once 'fns/require_sender_and_receiver.php';
require_sender_and_receiver($mysqli, 'can_send_calculation',
    $sender_address, $sender_username, $receiver_user);

include_once 'fns/require_calculation_params.php';
require_calculation_params($expression, $title,
    $tags, $tag_names, $value, $error, $error_char);

include_once '../fns/Users/Calculations/Received/add.php';
Users\Calculations\Received\add($mysqli, null,
    $sender_username, $receiver_user->id_users, $expression,
    $title, $tags, $value, $error, $error_char, $sender_address);

header('Content-Type: application/json');
echo 'true';
