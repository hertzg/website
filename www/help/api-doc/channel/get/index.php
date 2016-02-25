<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/channel_method_page.php';
channel_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the channel.',
        ],
        'channel_name' => [
            'type' => 'string',
            'description' => 'The name of the channel.',
        ],
        'public' => [
            'type' => 'boolean',
            'description' => 'Whether the channel is marked as public.',
        ],
        'receive_notifications' => [
            'type' => 'boolean',
            'description' => 'Whether the channel'
                .' owner receives notifications.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the channel was created.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the channel was last modified.',
        ],
    ],
], [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
]);
