<?php

function require_transaction ($mysqli, $base = '') {

    include_once __DIR__.'/request_transaction.php';
    list($transaction, $id, $user) = request_transaction($mysqli, $base);

    if (!$transaction) {
        $errors = ['The transaction no longer exists.'];
        $_SESSION['wallets/errors'] = $errors;
        unset($_SESSION['wallets/messages']);
        include_once __DIR__.'/../../fns/redirect.php';
        redirect("$base..");
    }

    return [$transaction, $id, $user];

}
