<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');

include_once 'fns/require_channel.php';
$channel = require_channel($mysqli, $user);

include_once 'fns/request_channel_params.php';
list($channel_name, $public,
    $receive_notifications) = request_channel_params($mysqli, $channel->id);

include_once '../../fns/Users/Channels/edit.php';
Users\Channels\edit($mysqli, $channel, $channel_name,
    $public, $receive_notifications, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
