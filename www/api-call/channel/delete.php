<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('channel/delete',
    'can_write_channels', $apiKey, $user, $mysqli);

include_once 'fns/require_channel.php';
$channel = require_channel($mysqli, $user);

include_once '../../fns/Users/Channels/delete.php';
Users\Channels\delete($mysqli, $channel);

header('Content-Type: application/json');
echo 'true';
