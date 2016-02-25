<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/wallet_method_page.php';
wallet_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the wallets.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'The name of the wallet.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the wallet was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the wallet was last modified.',
            ],
        ],
    ],
], []);
