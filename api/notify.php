<?php

include_once 'fns/hex2bin.php';
include_once 'fns/request_strings.php';
include_once 'fns/str_collapse_spaces_multiline.php';
include_once 'classes/Channels.php';
include_once 'classes/Notifications.php';

list($channelname, $channelkey, $notificationtext) = request_strings(
    'channelname', 'channelkey', 'notificationtext');

$channelkey = hex2bin($channelkey);

$channel = Channels::getByNameKey($channelname, $channelkey);
if (!$channel) {
    die(json_encode(array(
        'ok' => false,
        'msg' => 'Channel name or channel key is invalid.',
    )));
}

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
