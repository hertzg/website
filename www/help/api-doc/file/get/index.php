<?php

include_once '../fns/file_method_page.php';
file_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the file.',
        ],
        'name' => [
            'type' => 'string',
            'description' => 'The name of the file.',
        ],
        'size' => [
            'type' => 'number',
            'description' => 'The size of the content of the file in bytes.',
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
], [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
]);
