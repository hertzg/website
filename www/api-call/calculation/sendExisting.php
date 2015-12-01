<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_calculations', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once 'fns/require_calculation.php';
$calculation = require_calculation($mysqli, $user);

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli,
    $id_users, 'can_send_calculation');

include_once '../../fns/Users/Calculations/send.php';
Users\Calculations\send($mysqli, $user, $receiver_user->id_users, $calculation);

header('Content-Type: application/json');
echo 'true';
