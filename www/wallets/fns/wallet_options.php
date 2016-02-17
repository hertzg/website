<?php

function wallet_options ($wallets) {
    include_once __DIR__.'/../../fns/amount_text.php';
    $options = [];
    foreach ($wallets as $wallet) {
        $options[$wallet->id] = htmlspecialchars($wallet->name)
            .' &middot; '.amount_text($wallet->balance);
    }
    return $options;
}
