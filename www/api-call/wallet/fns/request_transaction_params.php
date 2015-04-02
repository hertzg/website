<?php

function request_transaction_params () {

    include_once __DIR__.'/../../../fns/WalletTransactions/request.php';
    list($amount, $parsed_amount, $description) = WalletTransactions\request();

    if ($parsed_amount === 0) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_AMOUNT');
    }

    return [$parsed_amount, $description];

}
