<?php

namespace Wallets;

function updateNumbers ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/mysqli_query_object.php";
    $wallets = mysqli_query_object($mysqli, 'select * from wallets');

    if (!$wallets) return;

    include_once __DIR__.'/editNumbers.php';
    include_once "$fnsDir/WalletTransactions/countOnWallet.php";
    foreach ($wallets as $wallet) {
        $id = $wallet->id;
        $num_transactions = \WalletTransactions\countOnWallet($mysqli, $id);
        editNumbers($mysqli, $id, $num_transactions);
    }

}
