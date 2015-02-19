<?php

function request_edit_transaction_values ($transaction, $key) {
    if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
    else {
        include_once __DIR__.'/../../fns/amount_text.php';
        $values = [
            'amount' => amount_text($transaction->amount, ''),
            'description' => $transaction->description,
        ];
    }
    return $values;
}
