<?php

include_once '../../fns/require_api_key.php';
require_api_key('channel/user/list',
    'can_read_channels', $apiKey, $user, $mysqli);

include_once '../fns/require_channel.php';
$channel = require_channel($mysqli, $user);

include_once '../../../fns/Users/Channels/Users/index.php';
$subscribedChannels = Users\Channels\Users\index($mysqli, $channel);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $subscribedChannels));
