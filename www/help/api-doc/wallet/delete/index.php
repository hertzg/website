<?php

include_once '../fns/wallet_method_page.php';
include_once '../../fns/true_result.php';
wallet_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to delete.',
    ],
], true_result(), [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
