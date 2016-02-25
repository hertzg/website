<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/transaction_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
transaction_method_page('deleteAll', [
    [
        'name' => 'id',
        'description' => 'The ID of the wallet to delete the transactions of.',
    ],
], ApiDoc\trueResult(), [
    'WALLET_NOT_FOUND' => "A wallet with the ID doesn't exist.",
]);
