<?php

function request_channel_params ($mysqli, $exclude_id = 0) {

    include_once __DIR__.'/../../../fns/Channels/request.php';
    list($channel_name, $public, $receive_notifications) = Channels\request();

    if ($channel_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_CHANNEL_NAME');
    }
    if (preg_match('/[^a-z0-9._-]/ui', $channel_name)) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('INVALID_CHANNEL_NAME');
    }

    $length = strlen($channel_name);

    include_once __DIR__.'/../../../fns/ChannelName/minLength.php';
    $minLength = ChannelName\minLength();

    if ($length < $minLength) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_NAME_TOO_SHORT');
    }

    include_once __DIR__.'/../../../fns/ChannelName/maxLength.php';
    $maxLength = ChannelName\maxLength();

    if ($length > $maxLength) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_NAME_TOO_LONG');
    }
    include_once __DIR__.'/../../../fns/Channels/getByName.php';
    if (Channels\getByName($mysqli, $channel_name, $exclude_id)) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CHANNEL_ALREADY_EXISTS');
    }

    return [$channel_name, $public, $receive_notifications];

}
