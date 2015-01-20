<?php

function require_transactions ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_wallet.php';
    list($wallet, $id, $user) = require_wallet($mysqli, $base);

    if (!$wallet->num_transactions) {
        unset(
            $_SESSION['calendar/errors'],
            $_SESSION['calendar/messages']
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base../view/?id=$id");
    }

    return $values;

}
