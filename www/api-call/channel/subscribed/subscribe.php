<?php

$fnsDir = '../../../fns';

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');
$id_users = $user->id_users;

include_once '../../fns/require_channel.php';
$channel = require_channel($mysqli);

if (!$channel->public) {
    include_once '../../../fns/ErrorJson/badRequest.php';
    ErrorJson\badRequest('"CHANNEL_NOT_PUBLIC"');
}

if ($channel->id_users == $id_users) {
    include_once '../../../fns/ErrorJson/badRequest.php';
    ErrorJson\badRequest('"CHANNEL_IS_OWN"');
}

include_once "$fnsDir/request_strings.php";
list($receive_notifications) = request_strings('receive_notifications');
$receive_notifications = (bool)$receive_notifications;

include_once "$fnsDir/SubscribedChannels/getExistingSubscriber.php";
$subscribedChannel = SubscribedChannels\getExistingSubscriber(
    $mysqli, $channel->id, $id_users);

if ($subscribedChannel && $subscribedChannel->subscriber_locked) {
    include_once '../../../fns/ErrorJson/badRequest.php';
    ErrorJson\badRequest('"ALREADY_SUBSCRIBED"');
}

include_once "$fnsDir/Users/SubscribedChannels/add.php";
$id = Users\SubscribedChannels\add($mysqli, $user,
    $channel, $subscribedChannel, $receive_notifications, $apiKey);

header('Content-Type: application/json');
echo $id;
