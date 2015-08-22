<?php

include_once '../fns/event_method_page.php';
event_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the events.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'The event text.',
            ],
            'event_time' => [
                'type' => 'number',
                'description' => 'The Unix timestamp of the day of the event.',
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
    ],
], []);
