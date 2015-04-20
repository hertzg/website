<?php

namespace Users\Wallets;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_wallets) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Wallets/indexOnUser.php";
    $wallets = \Wallets\indexOnUser($mysqli, $id_users);

    if ($wallets) {
        include_once __DIR__.'/../DeletedItems/addWallet.php';
        foreach ($wallets as $wallet) {
            \Users\DeletedItems\addWallet($mysqli, $wallet, $apiKey);
        }
    }

    include_once "$fnsDir/Wallets/deleteOnUser.php";
    \Wallets\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/WalletTransactions/setDeletedOnUser.php";
    \WalletTransactions\setDeletedOnUser($mysqli, $id_users);

    $sql = 'update users set num_wallets = 0, balance_total = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
