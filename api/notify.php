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
$notification_text = trim($notification_text);

if ($notification_text === '') {
    die(json_encode(array(
        'ok' => false,
        'msg' => 'Nofitication text cannot be left blank.',
    )));
}

include_once 'fns/send_notification.php';
send_notification($mysqli, $channel, $notification_text);

echo json_encode(array(
    'ok' => true,
    'msg' => 'Done.',
));
