<?php

namespace WalletTransactions;

function delete ($mysqli, $id) {
    $sql = "delete from wallet_transactions where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
