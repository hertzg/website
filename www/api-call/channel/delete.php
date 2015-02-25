<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');

include_once 'fns/require_channel.php';
$channel = require_channel($mysqli, $user);

include_once '../../fns/Users/Channels/delete.php';
Users\Channels\delete($mysqli, $channel);

header('Content-Type: application/json');
echo 'true';
