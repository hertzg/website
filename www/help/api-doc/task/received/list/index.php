<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_task_method_page.php';
received_task_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the received tasks.',
            ],
            'sender_username' => [
                'type' => 'string',
                'description' => 'The username of who sent the task.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'The text of the received task.',
            ],
            'deadline_time' => [
                'type' => 'string',
                'description' =>
                    'The Unix timestamp of the deadline of the received task.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'top_priority' => [
                'type' => 'boolean',
                'description' =>
                    'Whether the received task is marked as top priority.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the task was received.',
            ],
        ],
    ],
], []);
