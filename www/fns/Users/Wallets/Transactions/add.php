<?php

namespace Users\Wallets\Transactions;

function add ($mysqli, $id_users, $id_wallets, $parsed_amount, $description) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/WalletTransactions/add.php";
    \WalletTransactions\add($mysqli, $id_users,
        $id_wallets, $parsed_amount, $description);

    include_once "$fnsDir/Wallets/addTransaction.php";
    \Users\Wallets\addTransaction($mysqli, $id_wallets, $parsed_amount);

}
