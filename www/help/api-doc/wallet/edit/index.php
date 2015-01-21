<?php

include_once '../fns/wallet_method_page.php';
wallet_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to edit.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the wallet.',
    ],
], [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
    'ENTER_NAME' => 'The new name is empty.',
]);
