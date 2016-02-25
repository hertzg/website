<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/transaction_method_page.php';
transaction_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the transaction to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the transaction.',
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
            'description' =>
                'The Unix timestamp of when the transaction was last modified.',
        ],
    ],
], [
    'TRANSACTION_NOT_FOUND' => "A transaction with the ID doesn't exist.",
]);
