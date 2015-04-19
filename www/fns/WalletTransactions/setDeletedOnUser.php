<?php

namespace WalletTransactions;

function setDeletedOnUser ($mysqli, $id_users) {
    $sql = 'update wallet_transactions set deleted = 1'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
