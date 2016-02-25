<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/user_method_page.php';
user_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the user to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the user.',
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
], [
    'USER_NOT_FOUND' => "A user with the ID doesn't exist.",
]);
