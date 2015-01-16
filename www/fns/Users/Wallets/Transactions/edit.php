<?php

namespace Users\Wallets\Transactions;

function edit ($mysqli, $transaction, $amount, $description) {

    $fnsDir = __DIR__.'/../../..';

    $amount_diff = $amount - $transaction->amount;
    if ($amount_diff) {
        include_once "$fnsDir/Wallets/addBalance.php";
        \Wallets\addBalance($mysqli, $transaction->id_wallets, $amount_diff);
    }

    include_once "$fnsDir/WalletTransactions/edit.php";
    \WalletTransactions\edit($mysqli, $transaction->id, $amount, $description);

}
