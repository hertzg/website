<?php

namespace Users\Wallets\Transactions;

function edit ($mysqli, $wallet, $transaction,
    $amount, $description, $updateApiKey = null) {

    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;
    $amount_added = $amount - $transaction->amount;
    $balance_after = $transaction->balance_after + $amount_added;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/WalletTransactions/edit.php";
    \WalletTransactions\edit($mysqli, $id, $amount,
        $balance_after, $description, $updateApiKey);

    include_once "$fnsDir/WalletTransactions/addBalanceAfter.php";
    \WalletTransactions\addBalanceAfter($mysqli,
        $id_wallets, $id, $amount_added);

    if ($amount_added) {

        include_once "$fnsDir/Wallets/addBalance.php";
        \Wallets\addBalance($mysqli, $id_wallets, $amount_added);

        include_once __DIR__.'/../../addBalanceTotal.php';
        \Users\addBalanceTotal($mysqli, $transaction->id_users, $amount_added);

    }

}
