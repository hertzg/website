<?php

function require_wallet_and_multiple_wallets ($mysqli) {

    include_once __DIR__.'/../../fns/require_wallet.php';
    list($wallet, $id, $user) = require_wallet($mysqli);

    if ($user->num_wallets <= 1) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("../view/?id=$id");
    }

    return [$wallet, $id, $user];

}
