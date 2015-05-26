<?php

function require_wallet_and_multiple_wallets ($mysqli) {

    include_once __DIR__.'/../../fns/require_wallet.php';
    list($wallet, $id, $user) = require_wallet($mysqli);

    if ($user->num_wallets <= 1) {
        $error = 'You no longer have another wallet to transfer amount to.';
        $_SESSION['wallets/view/errors'] = [$error];
        unset($_SESSION['wallets/view/messages']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("../view/?id=$id");
    }

    return [$wallet, $id, $user];

}
