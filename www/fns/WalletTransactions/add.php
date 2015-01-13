<?php

namespace WalletTransactions;

function add ($mysqli, $id_users, $id_wallets, $amount, $description) {
    $description = $mysqli->real_escape_string($description);
    $insert_time = time();
    $sql = 'insert into wallet_transactions'
        .' (id_users, id_wallets,'
        .' amount, description, insert_time)'
        ." values ($id_users, $id_wallets,"
        ." $amount, '$description', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
