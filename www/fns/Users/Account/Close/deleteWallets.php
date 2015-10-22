<?php

namespace Users\Account\Close;

function deleteWallets ($mysqli, $user) {

    if (!$user->num_wallets) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Wallets/deleteOnUser.php";
    \Wallets\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/WalletTransactions/deleteOnUser.php";
    \WalletTransactions\deleteOnUser($mysqli, $id_users);

}
