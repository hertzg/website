<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');

include_once '../fns/require_channel.php';
$channel = require_channel($mysqli, $user->id_users);

include_once 'fns/require_channel_user_params.php';
$subscriberUser = require_channel_user_params($mysqli, $user, $channel);

include_once '../../../fns/SubscribedChannels/getExistingSubscriber.php';
$subscribedChannel = SubscribedChannels\getExistingSubscriber(
    $mysqli, $channel->id, $subscriberUser->id_users);

if (!$subscribedChannel || !$subscribedChannel->publisher_locked) {
    include_once '../../fns/bad_request.php';
    bad_request('USER_NOT_ADDED');
}

include_once '../../../fns/Users/Channels/Users/delete.php';
Users\Channels\Users\delete($mysqli, $subscribedChannel);

header('Content-Type: application/json');
echo 'true';
