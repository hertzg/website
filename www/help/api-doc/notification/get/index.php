<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/notification_method_page.php';
notification_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the notification to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the notification.',
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
], [
    'NOTIFICATION_NOT_FOUND' => "A notification with the ID doesn't exist.",
]);
