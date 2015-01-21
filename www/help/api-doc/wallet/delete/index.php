<?php

include_once '../fns/wallet_method_page.php';
wallet_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to delete.',
    ],
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
