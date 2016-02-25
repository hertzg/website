<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/transaction_method_page.php';
transaction_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to list the transactions of.',
    ],
], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the transactions.',
            ],
            'amount' => [
                'type' => 'number',
                'description' => 'The amount of the transaction.',
            ],
            'description' => [
                'type' => 'string',
                'description' => 'The description of the transaction.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the transaction was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' => 'The Unix timestamp of'
                    .' when the transaction was last modified.',
            ],
        ],
    ],
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
