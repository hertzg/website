<?php

namespace Users\Wallets\Transactions;

function edit ($mysqli, $transaction, $amount, $description) {

    $fnsDir = __DIR__.'/../../..';

    $amount_added = $amount - $transaction->amount;
    if ($amount_added) {

        include_once "$fnsDir/Wallets/addBalance.php";
        \Wallets\addBalance($mysqli, $transaction->id_wallets, $amount_added);

        include_once __DIR__.'/../../addBalanceTotal.php';
        \Users\addBalanceTotal($mysqli, $transaction->id_users, $amount_added);

    }

    include_once "$fnsDir/WalletTransactions/edit.php";
    \WalletTransactions\edit($mysqli, $transaction->id, $amount, $description);

}
