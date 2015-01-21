<?php

include_once '../fns/transaction_method_page.php';
transaction_method_page('deleteAll', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to delete the transactions in.',
    ],
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
