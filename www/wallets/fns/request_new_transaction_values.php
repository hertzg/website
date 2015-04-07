<?php

function request_new_transaction_values ($key) {
    if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
    else {

        include_once __DIR__.'/../../fns/WalletTransactions/request.php';
        $values = WalletTransactions\request();
        list($amount, $parsed_amount, $description) = $values;

        $values = [
            'amount' => $amount,
            'description' => $description,
        ];

    }
    return $values;
}
