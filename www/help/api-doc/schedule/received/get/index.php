<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_schedule_method_page.php';
received_schedule_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received schedule to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the received schedule.',
        ],
        'sender_username' => [
            'type' => 'string',
            'description' => 'The username of who sent the schedule.',
        ],
        'text' => [
            'type' => 'string',
            'description' => 'The text of the received schedule.',
        ],
        'interval' => [
            'type' => 'number',
            'description' =>
                'The number of days in which the received schedule repeats.',
        ],
        'offset' => [
            'type' => 'number',
            'description' => 'The number of days'
                .' from January 1st 1970 the next day'
                .' on which the received schedule is effective.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the schedule was received.',
        ],
    ],
], [
    'RECEIVED_SCHEDULE_NOT_FOUND' =>
        "A received schedule with the ID doesn't exist.",
]);
