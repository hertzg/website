<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/user_method_page.php';
user_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the users.',
            ],
            'username' => [
                'type' => 'string',
                'description' => 'The username of the user.',
            ],
            'storage_used' => [
                'type' => 'number',
                'description' =>
                    'The number of bytes used by the user for storing files.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the user was created.',
            ],
            'access_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the user was last accessed.',
            ],
        ],
    ],
], []);
