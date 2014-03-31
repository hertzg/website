<?php

include_once 'fns/request_strings.php';
list($channel_name, $channel_key, $notification_text) = request_strings(
    'channel_name', 'channel_key', 'notification_text');

list($channelname, $channelkey, $notificationtext) = request_strings(
    'channelname', 'channelkey', 'notificationtext');

if ($channelname !== '') $channel_name = $channelname;
if ($channelkey !== '') $channel_key = $channelkey;
if ($notificationtext !== '') $notification_text = $notificationtext;

include_once 'fns/hex2bin.php';
$channel_key = hex2bin($channel_key);

include_once 'fns/Channels/getByNameKey.php';
include_once 'lib/mysqli.php';
$channel = Channels\getByNameKey($mysqli, $channel_name, $channel_key);

if (!$channel) {
    die(json_encode(array(
        'ok' => false,
        'msg' => 'Channel name or channel key is invalid.',
    )));
}

include_once 'fns/str_collapse_spaces_multiline.php';
$notification_text = str_collapse_spaces_multiline($notification_text);

if ($notification_text === '') {
    die(json_encode(array(
        'ok' => false,
        'msg' => 'Nofitication text cannot be left blank.',
    )));
}

$id_users = $channel->id_users;
$id_channels = $channel->id;
$channel_name = $channel->channel_name;

include_once 'fns/Notifications/add.php';
Notifications\add($mysqli, $id_users, $id_channels,
    $channel_name, $notification_text);

include_once 'fns/Users/addNumNewNotifications.php';
Users\addNumNewNotifications($mysqli, $id_users, 1);

include_once 'fns/SubscribedChannels/indexOnChannel.php';
$subscribedChannels = SubscribedChannels\indexOnChannel($mysqli, $id_channels);

if ($subscribedChannels) {
    include_once 'fns/Notifications/addExternal.php';
    foreach ($subscribedChannels as $subscribedChannel) {
        if ($subscribedChannel->receive_notifications) {
            $id_users = $subscribedChannel->subscribed_id_users;
            Notifications\addExternal($mysqli, $id_users,
                $id_channels, $channel_name, $notification_text,
                $subscribedChannel->id);
            Users\addNumNewNotifications($mysqli, $id_users, 1);
        }
    }
}

echo json_encode(array(
    'ok' => true,
    'msg' => 'Done.',
));
