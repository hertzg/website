<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_channel.php';
list($id, $channel) = require_channel($mysqli, $id_users);

include_once 'fns/request_channel_params.php';
list($channel_name, $public) = request_channel_params($mysqli, $id);

include_once '../../fns/Users/Channels/edit.php';
Users\Channels\edit($mysqli, $id, $channel_name, $public);

header('Content-Type: application/json');
echo 'true';
