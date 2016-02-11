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
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"TRANSACTION_NOT_FOUND"');
    }

    return $transaction;

}
