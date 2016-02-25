<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/notification_method_page.php';
notification_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the notifications.',
            ],
            'channel_name' => [
                'type' => 'number',
                'description' => 'The name of the channel in which'
                    .' the notification is posted.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'The notification text.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the notification was posted.',
            ],
        ],
    ],
], []);
