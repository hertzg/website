<?php

namespace WalletTransactions;

function deleteOnWallet ($mysqli, $id_wallets) {
    $sql = "delete from wallet_transactions where id_wallets = $id_wallets";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
