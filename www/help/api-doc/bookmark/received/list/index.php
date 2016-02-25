<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_bookmark_method_page.php';
received_bookmark_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the received bookmarks.',
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
    ],
], []);
