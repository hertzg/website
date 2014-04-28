<?php

include_once '../fns/channel_method_page.php';
channel_method_page('add', [
    [
        'name' => 'channel_name',
        'description' => 'The name of the channel.',
    ],
    [
        'name' => 'public',
        'description' => 'Whether the channel should be marked as public.',
    ],
], [
    'ENTER_CHANNEL_NAME', 'INVALID_CHANNEL_NAME', 'CHANNEL_NAME_TOO_SHORT',
    'CHANNEL_NAME_TOO_LONG', 'CHANNEL_ALREADY_EXISTS',
]);
