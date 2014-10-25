<?php

function request_channel_params ($mysqli, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Channels/request.php";
    list($channel_name, $public, $receive_notifications) = Channels\request();

    if ($channel_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_CHANNEL_NAME');
    }

    include_once "$fnsDir/ChannelName/containsIllegalChars.php";
    if (ChannelName\containsIllegalChars($channel_name)) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('INVALID_CHANNEL_NAME');
    }

    include_once "$fnsDir/ChannelName/isShort.php";
    if (ChannelName\isShort($channel_name)) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_NAME_TOO_SHORT');
    }

    include_once "$fnsDir/ChannelName/isLong.php";
    if (ChannelName\isLong($channel_name)) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_NAME_TOO_LONG');
    }

    include_once "$fnsDir/Channels/getByName.php";
    if (Channels\getByName($mysqli, $channel_name, $exclude_id)) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_ALREADY_EXISTS');
    }

    return [$channel_name, $public, $receive_notifications];

}
