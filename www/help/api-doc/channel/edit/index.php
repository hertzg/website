<?php

include_once '../fns/channel_method_page.php';
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
        'description' => 'Whether the channel owner should receive notifications.',
    ],
], [
    'CHANNEL_NOT_FOUND', 'ENTER_CHANNEL_NAME', 'INVALID_CHANNEL_NAME',
    'CHANNEL_NAME_TOO_SHORT', 'CHANNEL_NAME_TOO_LONG', 'CHANNEL_ALREADY_EXISTS',
]);
