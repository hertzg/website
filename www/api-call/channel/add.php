<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/request_channel_params.php';
list($channel_name, $public) = request_channel_params($mysqli);

include_once '../../fns/Users/Channels/add.php';
$id = Users\Channels\add($mysqli, $user, $channel_name, $public);

header('Content-Type: application/json');
echo $id;
