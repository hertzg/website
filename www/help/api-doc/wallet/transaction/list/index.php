<?php

include_once '../fns/transaction_method_page.php';
transaction_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to list the transactions in.',
    ],
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
