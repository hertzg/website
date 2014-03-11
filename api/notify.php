<?php

include_once 'fns/request_strings.php';
list($channelname, $channelkey, $notificationtext) = request_strings(
    'channelname', 'channelkey', 'notificationtext');

include_once 'fns/hex2bin.php';
$channelkey = hex2bin($channelkey);

include_once 'fns/Channels/getByNameKey.php';
include_once 'lib/mysqli.php';
$channel = Channels\getByNameKey($mysqli, $channelname, $channelkey);

if (!$channel) {
    die(json_encode(array(
        'ok' => false,
        'msg' => 'Channel name or channel key is invalid.',
    )));
}

include_once 'fns/str_collapse_spaces_multiline.php';
$notificationtext = str_collapse_spaces_multiline($notificationtext);

if ($notificationtext === '') {
    die(json_encode(array(
        'ok' => false,
        'msg' => 'Nofitication text cannot be left blank.',
    )));
}

$idusers = $channel->idusers;
$idchannels = $channel->idchannels;

include_once 'fns/Notifications/add.php';
Notifications\add($mysqli, $idusers, $idchannels,
    $channel->channelname, $notificationtext);

include_once 'fns/Channels/addNumNotifications.php';
Channels\addNumNotifications($mysqli, $idchannels, 1);

include_once 'fns/Users/addNumNewNotifications.php';
Users\addNumNewNotifications($mysqli, $idusers, 1);

echo json_encode(array(
    'ok' => true,
    'msg' => 'Done.',
));
