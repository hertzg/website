<?php

namespace Channels;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ChannelName/request.php";
    $channel_name = \ChannelName\request();

    include_once "$fnsDir/request_strings.php";
    list($public, $receive_notifications) = request_strings(
        'public', 'receive_notifications');

    $public = (bool)$public;
    $receive_notifications = (bool)$receive_notifications;

    return [$channel_name, $public, $receive_notifications];

}
