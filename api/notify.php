<?php

include_once 'classes/Notifications.php';

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

Notifications::add($channel->idusers, $channel->idchannels, $channel->channelname, $notificationtext);
echo json_encode(array(
    'ok' => true,
    'msg' => 'Done.',
));
