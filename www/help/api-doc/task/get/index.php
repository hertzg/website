<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/task_method_page.php';
task_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the task to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the task.',
        ],
        'text' => [
            'type' => 'string',
            'description' => 'The text of the task.',
        ],
        'deadline_time' => [
            'type' => 'string',
            'description' => 'The Unix timestamp of the deadline of the task.',
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
            'description' => 'The Unix timestamp of when the task was created.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the task was last modified.',
        ],
    ],
], [
    'TASK_NOT_FOUND' => "A task with the ID doesn't exist.",
]);
