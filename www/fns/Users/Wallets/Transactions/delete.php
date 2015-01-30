<?php

namespace Users\Wallets\Transactions;

function delete ($mysqli, $transaction) {

    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;
    $amount = $transaction->amount;
    $fnsDir = __DIR__.'/../../../';

    include_once "$fnsDir/WalletTransactions/delete.php";
    \WalletTransactions\delete($mysqli, $id);

    include_once "$fnsDir/WalletTransactions/addBalanceAfter.php";
    \WalletTransactions\addBalanceAfter($mysqli, $id_wallets, $id, -$amount);

    include_once "$fnsDir/Wallets/removeTransaction.php";
    \Wallets\removeTransaction($mysqli, $id_wallets, $amount);

    include_once __DIR__.'/../../addBalanceTotal.php';
    \Users\addBalanceTotal($mysqli, $transaction->id_users, -$amount);

}
