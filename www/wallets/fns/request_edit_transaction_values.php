<?php

function request_edit_transaction_values ($transaction, $key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    include_once __DIR__.'/../../fns/amount_text.php';
    return [
        'amount' => amount_text($transaction->amount, ''),
        'description' => $transaction->description,
    ];

}
