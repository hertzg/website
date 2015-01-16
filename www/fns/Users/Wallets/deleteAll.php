<?php

namespace Users\Wallets;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Wallets/deleteOnUser.php";
    \Wallets\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/WalletTransactions/deleteOnUser.php";
    \WalletTransactions\deleteOnUser($mysqli, $id_users);

    $sql = 'update users set num_wallets = 0, balance_total = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
