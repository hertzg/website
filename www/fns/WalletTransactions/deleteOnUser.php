<?php

namespace WalletTransactions;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from wallet_transactions where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
