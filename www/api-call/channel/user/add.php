<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../fns/require_channel.php';
$channel = require_channel($mysqli, $user->id_users);

include_once 'fns/require_channel_user_params.php';
$values = require_channel_user_params($mysqli, $user, $channel);
list($subscriberUser, $subscribedChannel) = $values;

if ($subscribedChannel && $subscribedChannel->publisher_locked) {
    include_once '../../fns/bad_request.php';
    bad_request('USER_ALREADY_ADDED');
}

include_once "../../../fns/get_users_connection.php";
$connection = get_users_connection($mysqli, $subscriberUser, $user->id_users);

if (!$connection['can_send_channel']) {
    include_once '../../fns/bad_request.php';
    bad_request('USER_NOT_RECEIVING');
}

include_once '../../../fns/Users/Channels/Users/add.php';
Users\Channels\Users\add($mysqli, $user,
    $channel, $subscribedChannel, $subscriberUser);

header('Content-Type: application/json');
echo 'true';
