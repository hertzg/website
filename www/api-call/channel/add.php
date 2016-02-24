<?php

include_once '../fns/require_api_key.php';
require_api_key('channel/add', 'can_write_channels', $apiKey, $user, $mysqli);

include_once 'fns/require_channel_params.php';
require_channel_params($mysqli,
    $channel_name, $public, $receive_notifications);

include_once '../../fns/Users/Channels/add.php';
$id = Users\Channels\add($mysqli, $user,
    $channel_name, $public, $receive_notifications, $apiKey);

header('Content-Type: application/json');
echo $id;
