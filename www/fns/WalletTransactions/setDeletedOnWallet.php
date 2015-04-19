<?php

namespace WalletTransactions;

function setDeletedOnWallet ($mysqli, $id_wallets, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update wallet_transactions set deleted = $deleted"
        ." where id_wallets = $id_wallets";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
