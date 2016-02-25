<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/folder_method_page.php';
folder_method_page('list', [
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
                'description' => 'The ID of one of the folders.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'The name of the folder.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the folder was created.',
            ],
            'rename_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the folder was last renamed.',
            ],
        ],
    ],
], [
    'PARENT_FOLDER_NOT_FOUND' => "A parent folder with the ID doesn't exist.",
]);
