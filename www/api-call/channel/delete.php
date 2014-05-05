<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_channel.php';
list($id, $channel) = require_channel($mysqli, $id_users);

include_once '../../fns/Users/Channels/delete.php';
Users\Channels\delete($mysqli, $id, $id_users);

header('Content-Type: application/json');
echo 'true';
