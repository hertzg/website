<?php

function request_new_transaction_values ($key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    include_once __DIR__.'/../../fns/WalletTransactions/request.php';
    list($amount, $parsed_amount, $description) = WalletTransactions\request();

    return [
        'amount' => $amount,
        'description' => $description,
    ];

}
