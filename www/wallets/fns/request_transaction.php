<?php

function request_transaction ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/WalletTransactions/getNotDeletedOnUser.php";
    $transaction = WalletTransactions\getNotDeletedOnUser(
        $mysqli, $user->id_users, $id);

    return [$transaction, $id, $user];

}
