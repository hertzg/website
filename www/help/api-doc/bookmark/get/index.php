<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bookmark_method_page.php';
bookmark_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the bookmark.',
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
            'description' =>
                'The Unix timestamp of when the bookmark was last modified.',
        ],
    ],
], [
    'BOOKMARK_NOT_FOUND' => "A bookmark with the ID doesn't exist.",
]);
