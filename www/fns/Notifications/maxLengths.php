<?php

namespace Notifications;

function maxLengths () {
    include_once __DIR__.'/../ChannelName/maxLength.php';
    return [
        'channel_name' => \ChannelName\maxLength(),
        'text' => 4 * 1024,
    ];
}
