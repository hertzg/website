<?php

function get_values () {

    $key = 'wallets/quick-new-transaction/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'focus' => 'id_wallets',
        'id_wallets' => '',
        'amount' => '',
        'description' => '',
    ];

}
