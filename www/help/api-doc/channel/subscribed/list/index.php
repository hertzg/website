<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/subscribed_channel_method_page.php';
subscribed_channel_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the subscribed channels.',
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
                'description' => 'Whether the subscriber'
                    .' receives notifications.',
            ],
        ],
    ],
], []);
