<?php

function require_transaction ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/WalletTransactions/getNotDeletedOnUser.php";
    $transaction = WalletTransactions\getNotDeletedOnUser(
        $mysqli, $id_users, $id);

    if (!$transaction) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('TRANSACTION_NOT_FOUND');
    }

    return $transaction;

}
