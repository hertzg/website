<?php

namespace WalletTransactions;

function edit ($mysqli, $id, $amount, $description) {
    $description = $mysqli->real_escape_string($description);
    $update_time = time();
    $sql = "update wallet_transactions set amount = $amount,"
        ." description = '$description', update_time = $update_time,"
        ." revision = revision + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
