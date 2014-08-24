<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_channels');
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($channel_name, $receive_notifications) = request_strings(
    'channel_name', 'receive_notifications');

include_once '../../../fns/str_collapse_spaces.php';
$channel_name = str_collapse_spaces($channel_name);

if ($channel_name === '') {
    include_once '../../fns/bad_request.php';
    bad_request('ENTER_CHANNEL_NAME');
}

include_once '../../../fns/Channels/getByName.php';
$channel = Channels\getByName($mysqli, $channel_name);

if (!$channel) {
    include_once '../../fns/bad_request.php';
    bad_request('CHANNEL_NOT_FOUND');
}

if (!$channel->public) {
    include_once '../../fns/bad_request.php';
    bad_request('CHANNEL_NOT_PUBLIC');
}

if ($channel->id_users == $id_users) {
    include_once '../../fns/bad_request.php';
    bad_request('CHANNEL_IS_OWN');
}

include_once '../../../fns/SubscribedChannels/getExistingSubscriber.php';
$subscribedChannel = SubscribedChannels\getExistingSubscriber(
    $mysqli, $channel->id, $id_users);

if ($subscribedChannel && $subscribedChannel->subscriber_locked) {
    include_once '../../fns/bad_request.php';
    bad_request('ALREADY_SUBSCRIBED');
}

$receive_notifications = (bool)$receive_notifications;

include_once '../../../fns/Users/SubscribedChannels/add.php';
$id = Users\SubscribedChannels\add($mysqli, $user,
    $channel, $subscribedChannel, $receive_notifications);

header('Content-Type: application/json');
echo $id;
