<?php

namespace WalletTransactions;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = 'select * from wallet_transactions'
        ." where id_users = $id_users and id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
