<?php

function require_channel_params ($mysqli, &$channel_name,
    &$public, &$receive_notifications, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Channels/request.php";
    list($channel_name, $public, $receive_notifications) = Channels\request();

    if ($channel_name === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_CHANNEL_NAME"');
    }

    include_once "$fnsDir/ChannelName/containsIllegalChars.php";
    if (ChannelName\containsIllegalChars($channel_name)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"INVALID_CHANNEL_NAME"');
    }

    include_once "$fnsDir/ChannelName/isShort.php";
    if (ChannelName\isShort($channel_name)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"CHANNEL_NAME_TOO_SHORT"');
    }

    include_once "$fnsDir/Channels/getByName.php";
    if (Channels\getByName($mysqli, $channel_name, $exclude_id)) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"CHANNEL_ALREADY_EXISTS"');
    }

}
