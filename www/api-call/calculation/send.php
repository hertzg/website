<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_calculations', $apiKey, $user, $mysqli);
$id_users = $user->id_users;

include_once '../fns/require_receiver_user.php';
$receiver_user = require_receiver_user($mysqli, $id_users, 'can_send_calculation');

include_once 'fns/require_calculation_params.php';
require_calculation_params($url, $title, $tags, $tag_names);

include_once '../../fns/Users/Calculations/Received/add.php';
Users\Calculations\Received\add($mysqli, $id_users, $user->username,
    $receiver_user->id_users, $url, $title, $tags);

header('Content-Type: application/json');
echo 'true';
