<?php

function require_channel ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($channel_name) = request_strings('channel_name');

    include_once "$fnsDir/str_collapse_spaces.php";
    $channel_name = str_collapse_spaces($channel_name);

    if ($channel_name === '') {
        include_once __DIR__.'/bad_request.php';
        bad_request('ENTER_CHANNEL_NAME');
    }

    include_once "$fnsDir/ChannelName/isValid.php";
    if (!ChannelName\isValid($channel_name)) {
        include_once __DIR__.'/bad_request.php';
        bad_request('INVALID_CHANNEL_NAME');
    }

    include_once "$fnsDir/Channels/getByName.php";
    $channel = Channels\getByName($mysqli, $channel_name);

    if (!$channel) {
        include_once __DIR__.'/bad_request.php';
        bad_request('CHANNEL_NOT_FOUND');
    }

    return $channel;

}
