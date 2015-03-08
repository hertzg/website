<?php

namespace Channels;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ChannelName/maxLength.php";
    $channelNameMaxLength = \ChannelName\maxLength();

    return [
        'channel_name' => $channelNameMaxLength,
        'lowercase_name' => $channelNameMaxLength,
    ];

}
