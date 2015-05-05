<?php

namespace Users\Wallets\Transactions;

function edit ($mysqli, $wallet, $transaction,
    $amount, $description, $updateApiKey = null) {

    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;
    $old_amount = $transaction->amount;
    $amount_added = $amount - $old_amount;
    $balance_after = $transaction->balance_after + $amount_added;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/WalletTransactions/edit.php";
    \WalletTransactions\edit($mysqli, $id, $amount,
        $balance_after, $description, $updateApiKey);

    include_once "$fnsDir/WalletTransactions/addBalanceAfter.php";
    \WalletTransactions\addBalanceAfter($mysqli,
        $id_wallets, $id, $amount_added);

    if ($amount_added) {

        if ($old_amount > 0) {
            if ($amount > 0) {
                $income = $amount - $old_amount;
                $expense = 0;
            } else {
                $income = -$old_amount;
                $expense = -$amount;
            }
        } else {
            if ($amount > 0) {
                $income = $amount;
                $expense = $old_amount;
            } else {
                $income = 0;
                $expense = $old_amount - $amount;
            }
        }

        include_once "$fnsDir/Wallets/addAmounts.php";
        \Wallets\addAmounts($mysqli, $id_wallets,
            $income, $expense, $amount_added);

        include_once __DIR__.'/../../addBalanceTotal.php';
        \Users\addBalanceTotal($mysqli, $transaction->id_users, $amount_added);

    }

}
