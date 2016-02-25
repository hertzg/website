<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_file_method_page.php';
received_file_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received file to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the received file.',
        ],
        'sender_username' => [
            'type' => 'string',
            'description' => 'The username of who sent the file.',
        ],
        'name' => [
            'type' => 'string',
            'description' => 'The name of the received file.',
        ],
        'size' => [
            'type' => 'number',
            'description' =>
                'The size of the content of the received file in bytes.',
        ],
        'md5_sum' => [
            'type' => 'string',
            'description' => 'The MD5 hash of the content of the file.',
        ],
        'sha256_sum' => [
            'type' => 'string',
            'description' => 'The SHA-256 hash of the content of the file.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the file was received.',
        ],
    ],
], [
    'RECEIVED_FILE_NOT_FOUND' => "A received file with the ID doesn't exist.",
]);
