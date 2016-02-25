<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/transaction_method_page.php';
transaction_method_page('add', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to add the transaction to.',
    ],
    [
        'name' => 'amount',
        'description' => 'The amount of the transaction.',
    ],
    [
        'name' => 'description',
        'description' => 'The description of the transaction.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created transaction.',
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
    'ENTER_AMOUNT' => 'The amount is zero.',
]);
