<?php

namespace Users\Wallets\Transactions;

function delete ($mysqli, $transaction) {

    $amount = $transaction->amount;
    $fnsDir = __DIR__.'/../../../';

    include_once "$fnsDir/WalletTransactions/delete.php";
    \WalletTransactions\delete($mysqli, $transaction->id);

    include_once "$fnsDir/Wallets/removeTransaction.php";
    \Wallets\removeTransaction($mysqli, $transaction->id_wallets, $amount);

    include_once __DIR__.'/../../addBalanceTotal.php';
    \Users\addBalanceTotal($mysqli, $transaction->id_users, -$amount);

}
