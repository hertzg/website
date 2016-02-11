<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_write_channels', $apiKey, $user, $mysqli);

include_once '../fns/require_channel.php';
$channel = require_channel($mysqli, $user);

include_once 'fns/require_channel_user_params.php';
require_channel_user_params($mysqli, $user, $channel, $subscriberUser);

include_once '../../../fns/SubscribedChannels/getExistingSubscriber.php';
$subscribedChannel = SubscribedChannels\getExistingSubscriber(
    $mysqli, $channel->id, $subscriberUser->id_users);

if (!$subscribedChannel || !$subscribedChannel->publisher_locked) {
    include_once '../../../fns/ApiCall/Error/badRequest.php';
    ApiCall\Error\badRequest('"USER_NOT_ADDED"');
}

include_once '../../../fns/Users/Channels/Users/delete.php';
Users\Channels\Users\delete($mysqli, $subscribedChannel);

header('Content-Type: application/json');
echo 'true';
