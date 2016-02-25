<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/transaction_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
transaction_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the transaction to delete.',
    ],
], ApiDoc\trueResult(), [
    'TRANSACTION_NOT_FOUND' => "A transaction with the ID doesn't exist.",
]);
