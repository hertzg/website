<?php

namespace Users\Wallets;

function delete ($mysqli, $wallet) {

    $id = $wallet->id;
    $id_users = $wallet->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Wallets/delete.php";
    \Wallets\delete($mysqli, $id);

    include_once "$fnsDir/WalletTransactions/deleteOnWallet.php";
    \WalletTransactions\deleteOnWallet($mysqli, $wallet->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../addBalanceTotal.php';
    \Users\addBalanceTotal($mysqli, $id_users, -$wallet->balance);

}
