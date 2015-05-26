<?php

function require_transactions ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_wallet.php';
    $values = require_wallet($mysqli, $base);
    list($wallet, $id, $user) = $values;

    if (!$wallet->num_transactions) {
        unset(
            $_SESSION['wallets/view/errors'],
            $_SESSION['wallets/view/messages']
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base../view/?id=$id");
    }

    return $values;

}
