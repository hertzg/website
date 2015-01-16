<?php

function require_transactions ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_wallet.php';
    $values = require_wallet($mysqli, $base);
    list($wallet, $id, $user) = $values;

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
