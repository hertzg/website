<?php

namespace Users\Wallets;

function delete ($mysqli, $wallet, $apiKey = null) {

    $id = $wallet->id;
    $id_users = $wallet->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Wallets/delete.php";
    \Wallets\delete($mysqli, $id);

    if ($wallet->num_transactions) {
        include_once "$fnsDir/WalletTransactions/setDeletedOnWallet.php";
        \WalletTransactions\setDeletedOnWallet($mysqli, $id, true);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../addBalanceTotal.php';
    \Users\addBalanceTotal($mysqli, $id_users, -$wallet->balance);

    include_once __DIR__.'/../DeletedItems/addWallet.php';
    \Users\DeletedItems\addWallet($mysqli, $wallet, $apiKey);

}
