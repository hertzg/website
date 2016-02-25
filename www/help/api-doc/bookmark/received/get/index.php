<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_bookmark_method_page.php';
received_bookmark_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the received bookmark.',
        ],
        'sender_username' => [
            'type' => 'string',
            'description' => 'The username of who sent the bookmark.',
        ],
        'url' => [
            'type' => 'string',
            'description' => 'The URL of the received bookmark.',
        ],
        'title' => [
            'type' => 'string',
            'description' => 'The title of the received bookmark.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the bookmark was received.',
        ],
    ],
], [
    'RECEIVED_BOOKMARK_NOT_FOUND' =>
        "A received bookmark with the ID doesn't exist.",
]);
