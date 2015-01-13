<?php

namespace Users\Wallets;

function delete ($mysqli, $wallet) {

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Wallets/delete.php";
    \Wallets\delete($mysqli, $id);

    include_once "$fnsDir/WalletTransactions/deleteOnWallet.php";
    \WalletTransactions\deleteOnWallet($mysqli, $wallet->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $wallet->id_users, -1);

}
