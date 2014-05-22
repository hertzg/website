<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/request_channel_params.php';
$values = request_channel_params($mysqli);
list($channel_name, $public, $receive_notifications) = $values;

include_once '../../fns/Users/Channels/add.php';
$id = Users\Channels\add($mysqli, $user,
    $channel_name, $public, $receive_notifications);

header('Content-Type: application/json');
echo $id;
