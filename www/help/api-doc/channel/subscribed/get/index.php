<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/subscribed_channel_method_page.php';
subscribed_channel_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the subscribed channel to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the subscribed channel.',
        ],
        'channel_name' => [
            'type' => 'string',
            'description' => 'The name of the subscribed channel.',
        ],
        'channel_public' => [
            'type' => 'boolean',
            'description' => 'Whether the subscribed channel is public.',
        ],
        'receive_notifications' => [
            'type' => 'boolean',
            'description' => 'Whether the subscriber receives notifications.',
        ],
    ],
], [
    'SUBSCRIBED_CHANNEL_NOT_FOUND' =>
        "A subscribed channel with the ID doesn't exist.",
]);
