<?php

namespace WalletTransactions;

function addBalanceAfter ($mysqli, $id_wallets, $after_ordinal, $amount) {
    $sql = 'update wallet_transactions set'
        ." balance_after = balance_after + $amount"
        ." where id_wallets = $id_wallets and ordinal > $after_ordinal";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
