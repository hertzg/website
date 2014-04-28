<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_channel.php';
list($id, $channel) = require_channel($mysqli, $id_users);

include_once '../../fns/Notifications/deleteOnChannel.php';
Notifications\deleteOnChannel($mysqli, $id);

include_once '../../fns/Channels/delete.php';
Channels\delete($mysqli, $id);

include_once '../../fns/SubscribedChannels/deleteOnChannel.php';
SubscribedChannels\deleteOnChannel($mysqli, $id);

include_once '../../fns/Users/addNumChannels.php';
Users\addNumChannels($mysqli, $id_users, -1);

include_once '../../fns/Users/clearNumNotifications.php';
Users\clearNumNotifications($mysqli, $id_users);

header('Content-Type: application/json');
echo 'true';
