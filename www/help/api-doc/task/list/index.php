<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/task_method_page.php';
task_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the tasks.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'The text of the task.',
            ],
            'deadline_time' => [
                'type' => 'string',
                'description' =>
                    'The Unix timestamp of the deadline of the task.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'top_priority' => [
                'type' => 'boolean',
                'description' => 'Whether the task is marked as top priority.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the task was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the task was last modified.',
            ],
        ],
    ],
], []);
