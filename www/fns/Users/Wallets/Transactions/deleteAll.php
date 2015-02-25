<?php

namespace Users\Wallets\Transactions;

function deleteAll ($mysqli, $wallet) {

    if (!$wallet->num_transactions) return;

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/WalletTransactions/deleteOnWallet.php";
    \WalletTransactions\deleteOnWallet($mysqli, $id);

    include_once "$fnsDir/Wallets/removeAllTransactions.php";
    \Wallets\removeAllTransactions($mysqli, $id);

    $balance = $wallet->balance;
    if ($balance) {
        include_once __DIR__.'/../../addBalanceTotal.php';
        \Users\addBalanceTotal($mysqli, $wallet->id_users, -$balance);
    }

}
