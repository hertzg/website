<?php

namespace WalletTransactions;

function indexLimitOnWallet ($mysqli, $id_wallets, $limit) {
    $sql = "select * from wallet_transactions where id_wallets = $id_wallets"
        ." order by insert_time desc limit $limit";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
