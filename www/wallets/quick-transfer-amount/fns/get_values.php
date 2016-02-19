<?php

function get_values ($wallets) {

    $key = 'wallets/quick-transfer-amount/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'focus' => 'from_id',
        'from_id' => $wallets[0]->id,
        'to_id' => $wallets[1]->id,
        'amount' => '',
        'description' => '',
    ];

}
