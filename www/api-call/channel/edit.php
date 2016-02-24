<?php

include_once '../fns/require_api_key.php';
require_api_key('channel/edit', 'can_write_channels', $apiKey, $user, $mysqli);

include_once 'fns/require_channel.php';
$channel = require_channel($mysqli, $user);

include_once 'fns/require_channel_params.php';
require_channel_params($mysqli, $channel_name,
    $public, $receive_notifications, $channel->id);

include_once '../../fns/Users/Channels/edit.php';
Users\Channels\edit($mysqli, $channel, $channel_name,
    $public, $receive_notifications, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
