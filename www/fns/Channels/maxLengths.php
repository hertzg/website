<?php

namespace Channels;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ChannelName/maxLength.php";
    $channelNameMaxLength = \ChannelName\maxLength();

    include_once "$fnsDir/ApiKeyName/maxLength.php";
    $apiKeyNameMaxLength = \ApiKeyName\maxLength();

    return [
        'channel_name' => $channelNameMaxLength,
        'insert_api_key_name' => $apiKeyNameMaxLength,
        'lowercase_name' => $channelNameMaxLength,
        'update_api_key_name' => $apiKeyNameMaxLength,
    ];

}
