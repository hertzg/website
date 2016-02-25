<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/channel_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/ChannelName/minLength.php';
channel_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to edit.',
    ],
    [
        'name' => 'channel_name',
        'description' => 'The new name of the channel.',
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
], ApiDoc\trueResult(), [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
    'ENTER_CHANNEL_NAME' => 'The new name is empty.',
    'INVALID_CHANNEL_NAME' => 'The new name is invalid.',
    'CHANNEL_NAME_TOO_SHORT' =>
        'The channel name is shorter'
        .' than '.ChannelName\minLength().' characters.',
    'CHANNEL_ALREADY_EXISTS' => 'A channel with the same name already exists.',
]);
