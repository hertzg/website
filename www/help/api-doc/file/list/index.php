<?php

include_once '../fns/file_method_page.php';
file_method_page('list', [
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the files.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'The name of the file.',
            ],
            'size' => [
                'type' => 'number',
                'description' => 'The content size of the file in bytes.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the file was created.',
            ],
            'rename_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the file was last renamed.',
            ],
        ],
    ],
], [
    'PARENT_FOLDER_NOT_FOUND' => "A parent folder with the ID doesn't exist.",
]);
