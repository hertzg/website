<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bookmark_method_page.php';
bookmark_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the bookmarks.',
            ],
            'url' => [
                'type' => 'string',
                'description' => 'The URL of the bookmark.',
            ],
            'title' => [
                'type' => 'string',
                'description' => 'The title of the bookmark.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the bookmark was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' => 'The Unix timestamp of'
                    .' when the bookmark was last modified.',
            ],
        ],
    ],
], []);
