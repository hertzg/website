<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/folder_method_page.php';
folder_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the folder.',
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
], [
    'FOLDER_NOT_FOUND' => "A folder with the ID doesn't exist.",
]);
