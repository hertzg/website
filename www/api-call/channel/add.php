<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/request_channel_params.php';
list($channel_name, $public) = request_channel_params($mysqli);

include_once '../../fns/Channels/add.php';
$id = Channels\add($mysqli, $id_users, $user->username, $channel_name, $public);

include_once '../../fns/Users/addNumChannels.php';
Users\addNumChannels($mysqli, $id_users, 1);

header('Content-Type: application/json');
echo $id;
