<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');

include_once 'fns/require_channel.php';
$channel = require_channel($mysqli, $user);
$id = $channel->id;

include_once 'fns/request_channel_params.php';
$values = request_channel_params($mysqli, $id);
list($channel_name, $public, $receive_notifications) = $values;

include_once '../../fns/Users/Channels/edit.php';
Users\Channels\edit($mysqli, $id, $channel_name,
    $public, $receive_notifications, $apiKey);

header('Content-Type: application/json');
echo 'true';
