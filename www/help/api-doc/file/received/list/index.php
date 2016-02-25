<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_file_method_page.php';
received_file_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the received files.',
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
    ],
], []);
