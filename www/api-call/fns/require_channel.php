<?php

function require_channel ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ChannelName/request.php";
    $channel_name = ChannelName\request();

    if ($channel_name === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_CHANNEL_NAME"');
    }

    include_once "$fnsDir/ChannelName/isValid.php";
    if (!ChannelName\isValid($channel_name)) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"INVALID_CHANNEL_NAME"');
    }

    include_once "$fnsDir/Channels/getByName.php";
    $channel = Channels\getByName($mysqli, $channel_name);

    if (!$channel) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"CHANNEL_NOT_FOUND"');
    }

    return $channel;

}
