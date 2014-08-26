<?php

include_once '../fns/channel_method_page.php';
include_once '../../../../fns/ChannelName/maxLength.php';
include_once '../../../../fns/ChannelName/minLength.php';
channel_method_page('add', [
    [
        'name' => 'channel_name',
        'description' => 'The name of the channel.',
    ],
    [
        'name' => 'public',
        'description' => 'Whether the channel should be marked as public.',
    ],
    [
        'name' => 'receive_notifications',
        'description' => 'Whether the channel owner'
            .' should receive notifications.',
    ],
], [
    'ENTER_CHANNEL_NAME' => 'The name is empty.',
    'INVALID_CHANNEL_NAME' => 'The name is invalid.',
    'CHANNEL_NAME_TOO_SHORT' =>
        'The channel name is shorter'
        .' than '.ChannelName\minLength().' characters.',
    'CHANNEL_NAME_TOO_LONG' =>
        'The channel name is longer'
        .' than '.ChannelName\maxLength().' characters.',
    'CHANNEL_ALREADY_EXISTS' => 'A channel with the same name already exists.',
]);
