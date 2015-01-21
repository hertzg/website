<?php

include_once '../fns/transaction_method_page.php';
transaction_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the transaction to edit.',
    ],
    [
        'name' => 'amount',
        'description' => 'The new amount of the transaction.',
    ],
    [
        'name' => 'description',
        'description' => 'The new description of the transaction.',
    ],
], [
    'TRANSACTION_NOT_FOUND' => "A transaction with the ID doesn't exist.",
    'ENTER_AMOUNT' => 'The new amount is zero.',
]);
