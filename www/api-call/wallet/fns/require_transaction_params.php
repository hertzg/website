<?php

function require_transaction_params (&$parsed_amount, &$description) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/WalletTransactions/request.php";
    list($amount, $parsed_amount, $description) = WalletTransactions\request();

    if ($parsed_amount === 0) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_AMOUNT"');
    }

}
