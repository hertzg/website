<?php

function require_transaction ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/WalletTransactions/getOnUser.php";
    $transaction = WalletTransactions\getOnUser(
        $mysqli, $user->id_users, $id);

    if (!$transaction) {
        $errors = ['The transaction no longer exists.'];
        $_SESSION['wallets/errors'] = $errors;
        unset($_SESSION['wallets/messages']);
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$transaction, $id, $user];

}
