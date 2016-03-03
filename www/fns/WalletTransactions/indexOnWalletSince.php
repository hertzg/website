<?php

namespace WalletTransactions;

function indexOnWalletSince ($mysqli, $id_wallets, $insert_time) {
    $sql = 'select * from wallet_transactions'
        ." where id_wallets = $id_wallets and insert_time >= $insert_time"
        .' order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
