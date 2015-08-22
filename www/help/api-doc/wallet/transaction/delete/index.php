<?php

include_once '../fns/transaction_method_page.php';
include_once '../../../fns/true_result.php';
transaction_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the transaction to delete.',
    ],
], true_result(), [
    'TRANSACTION_NOT_FOUND' => "A transaction with the ID doesn't exist.",
]);
