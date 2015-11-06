<?php

function request_transaction_params (&$errors, &$focus) {

    include_once __DIR__.'/../../fns/WalletTransactions/request.php';
    $values = WalletTransactions\request();
    list($amount, $parsed_amount, $description) = $values;

    if ($amount === '') {
        $errors[] = 'Enter amount.';
        if ($focus === null) $focus = 'amount';
    } elseif ($parsed_amount === 0) {
        $errors[] = 'The amount is invalid.';
        if ($focus === null) $focus = 'amount';
    }

    return $values;

}
