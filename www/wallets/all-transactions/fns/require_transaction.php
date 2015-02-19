<?php

function require_transaction ($mysqli) {

    include_once __DIR__.'/../../fns/request_transaction.php';
    list($transaction, $id, $user) = request_transaction($mysqli, '../');

    if (!$transaction) {
        $errors = ['The transaction no longer exists.'];
        $_SESSION['wallets/errors'] = $errors;
        unset($_SESSION['wallets/messages']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('../..');
    }

    return [$transaction, $id, $user];

}
