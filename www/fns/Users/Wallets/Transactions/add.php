<?php

namespace Users\Wallets\Transactions;

function add ($mysqli, $wallet, $amount, $description, $insertApiKey = null) {

    $id_wallets = $wallet->id;
    $id_users = $wallet->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/WalletTransactions/add.php";
    $id = \WalletTransactions\add($mysqli, $id_users, $id_wallets,
        $amount, 0, $description, $wallet->num_transactions, $insertApiKey);

    include_once "$fnsDir/Wallets/addTransaction.php";
    \Users\Wallets\addTransaction($mysqli, $id_wallets, $amount);

    include_once __DIR__.'/../../addBalanceTotal.php';
    \Users\addBalanceTotal($mysqli, $id_users, $amount);

    return $id;

}
