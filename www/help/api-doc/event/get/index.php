<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/event_method_page.php';
event_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the event.',
        ],
        'text' => [
            'type' => 'string',
            'description' => 'The event text.',
        ],
        'event_time' => [
            'type' => 'number',
            'description' => 'The Unix timestamp of the day of the event.',
        ],
        'start_hour' => [
            'type' => 'number',
            'description' => 'The hour when the event starts.',
        ],
        'start_minute' => [
            'type' => 'number',
            'description' => 'The minute when the event starts.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the event was created.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the event was last modified.',
        ],
    ],
], [
    'EVENT_NOT_FOUND' => "An event with the ID doesn't exist.",
]);
