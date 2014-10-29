<?php

namespace Notifications;

function maxLengths () {
    $fnsDir = __DIR__.'/..';
    include_once "$fnsDir/ChannelName/maxLength.php";
    include_once "$fnsDir/ApiKeyName/maxLength.php";
    return [
        'channel_name' => \ChannelName\maxLength(),
        'insert_api_key_name' => \ApiKeyName\maxLength(),
        'text' => 4 * 1024,
    ];
}
