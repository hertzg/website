<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_folder_method_page.php';
received_folder_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the received folders.',
            ],
            'sender_username' => [
                'type' => 'string',
                'description' => 'The username of who sent the folder.',
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
], []);
