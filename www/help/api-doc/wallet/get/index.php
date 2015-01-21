<?php

include_once '../fns/wallet_method_page.php';
wallet_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to get.',
    ],
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
