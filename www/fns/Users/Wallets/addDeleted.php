<?php

namespace Users\Wallets;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $balance = $data->balance;
    $num_transactions = $data->num_transactions;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Wallets/addDeleted.php";
    \Wallets\addDeleted($mysqli, $id, $id_users, $data->name, $data->income,
        $data->expense, $balance, $num_transactions, $data->insert_time,
        $data->update_time, $data->revision);

    if ($num_transactions) {
        include_once "$fnsDir/WalletTransactions/setDeletedOnWallet.php";
        \WalletTransactions\setDeletedOnWallet($mysqli, $id, false);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    if ($balance) {
        include_once __DIR__.'/../addBalanceTotal.php';
        \Users\addBalanceTotal($mysqli, $id_users, $balance);
    }

}
