<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/wallet_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
wallet_method_page('transferAmount', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to transfer an amount from.',
    ],
    [
        'name' => 'to_id',
        'description' => 'The ID of the wallet to transfer an amount to.',
    ],
    [
        'name' => 'amount',
        'description' => 'The amount to transfer.',
    ],
    [
        'name' => 'description',
        'description' => 'The description of the transaction.',
    ],
], ApiDoc\trueResult(), [
    'WALLET_NOT_FOUND' =>
        "A wallet with the ID to transfer the amount from doesn't exist.",
    'TO_WALLET_NOT_FOUND' =>
        "A wallet with the ID to transfer the amount to doesn't exist.",
    'TO_WALLET_SAME' => 'The wallet to transfer from'
        .' and the wallet to transfer to are the same.',
    'ENTER_AMOUNT' => 'The amount is zero.',
]);
