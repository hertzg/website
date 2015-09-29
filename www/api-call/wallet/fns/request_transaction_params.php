<?php

function request_transaction_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/WalletTransactions/request.php";
    list($amount, $parsed_amount, $description) = WalletTransactions\request();

    if ($parsed_amount === 0) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_AMOUNT"');
    }

    return [$parsed_amount, $description];

}
