<?php

namespace WalletTransactions;

function addBalanceAfter ($mysqli, $id_wallets, $id, $amount) {
    $sql = 'update wallet_transactions set'
        ." balance_after = balance_after + $amount"
        ." where id_wallets = $id_wallets and id > $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
