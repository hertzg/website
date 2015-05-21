<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');

include_once 'fns/request_channel_params.php';
list($channel_name, $public,
    $receive_notifications) = request_channel_params($mysqli);

include_once '../../fns/Users/Channels/add.php';
$id = Users\Channels\add($mysqli, $user,
    $channel_name, $public, $receive_notifications, $apiKey);

header('Content-Type: application/json');
echo $id;
