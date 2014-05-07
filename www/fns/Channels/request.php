<?php

namespace Channels;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($channel_name, $public, $receive_notifications) = request_strings(
        'channel_name', 'public', 'receive_notifications');

    $public = (bool)$public;
    $receive_notifications = (bool)$receive_notifications;

    return [$channel_name, $public, $receive_notifications];

}
