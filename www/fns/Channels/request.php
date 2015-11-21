<?php

namespace Channels;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($channel_name, $public, $receive_notifications) = request_strings(
        'channel_name', 'public', 'receive_notifications');

    include_once "$fnsDir/ChannelName/maxLength.php";
    $channel_name = mb_substr($channel_name, 0,
        \ChannelName\maxLength(), 'UTF-8');

    $public = (bool)$public;
    $receive_notifications = (bool)$receive_notifications;

    return [$channel_name, $public, $receive_notifications];

}
