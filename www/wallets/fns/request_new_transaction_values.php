<?php

function request_new_transaction_values ($key) {
    if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
    else {
        $values = [
            'amount' => '',
            'description' => '',
        ];
    }
    return $values;
}
