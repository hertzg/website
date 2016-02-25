<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/channel_method_page.php';
channel_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one the channels.',
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
    ],
], []);
