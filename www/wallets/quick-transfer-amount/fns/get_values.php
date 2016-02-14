<?php

function get_values ($wallets) {

    $key = 'wallets/quick-transfer-amount/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];


    return [
        'focus' => 'from_id_wallets',
        'from_id_wallets' => $wallets[0]->id,
        'to_id_wallets' => $wallets[1]->id,
        'amount' => '',
        'description' => '',
    ];

}
