<?php

include_once '../fns/transaction_method_page.php';
transaction_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the transaction to delete.',
    ],
], [
    'TRANSACTION_NOT_FOUND' => "A transaction with the ID doesn't exist.",
]);
