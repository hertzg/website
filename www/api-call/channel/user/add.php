<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');
$id_users = $user->id_users;

include_once '../fns/require_channel.php';
$channel = require_channel($mysqli, $id_users);

include_once 'fns/require_channel_user_params.php';
$subscriberUser = require_channel_user_params($mysqli, $user, $channel);

$subscriber_id_users = $subscriberUser->id_users;

if ($subscriber_id_users == $id_users) {
    include_once '../../fns/bad_request.php';
    bad_request('USER_IS_SELF');
}

$fnsDir = '../../../fns';

include_once "$fnsDir/SubscribedChannels/getExistingSubscriber.php";
$subscribedChannel = SubscribedChannels\getExistingSubscriber(
    $mysqli, $channel->id, $subscriber_id_users);

if ($subscribedChannel && $subscribedChannel->publisher_locked) {
    include_once '../../fns/bad_request.php';
    bad_request('USER_ALREADY_ADDED');
}

include_once "$fnsDir/get_users_connection.php";
$connection = get_users_connection($mysqli, $subscriberUser, $id_users);

if (!$connection['can_send_channel']) {
    include_once '../../fns/bad_request.php';
    bad_request('USER_NOT_RECEIVING');
}

include_once "$fnsDir/Users/Channels/Users/add.php";
Users\Channels\Users\add($mysqli, $user,
    $channel, $subscribedChannel, $subscriberUser);

header('Content-Type: application/json');
echo 'true';
