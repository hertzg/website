<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/schedule_method_page.php';
schedule_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the schedules.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'The text of the schedule.',
            ],
            'interval' => [
                'type' => 'number',
                'description' =>
                    'The number of days in which the schedule repeats.',
            ],
            'offset' => [
                'type' => 'number',
                'description' => 'The number of days from January 1st 1970'
                    .' to the next day on which the schedule is effective.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the schedule was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' => 'The Unix timestamp of'
                    .' when the schedule was last modified.',
            ],
        ],
    ],
], []);
