<?php

namespace WalletTransactions;

function countOnWallet ($mysqli, $id_wallets) {
    $sql = 'select count(*) value from wallet_transactions'
        ." where id_wallets = $id_wallets";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
