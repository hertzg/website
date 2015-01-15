<?php

namespace Users\Wallets\Transactions;

function delete ($mysqli, $transaction) {

    $fnsDir = __DIR__.'/../../../';

    include_once "$fnsDir/WalletTransactions/delete.php";
    \WalletTransactions\delete($mysqli, $transaction->id);

    include_once "$fnsDir/Wallets/removeTransaction.php";
    \Wallets\removeTransaction($mysqli,
        $transaction->id_wallets, $transaction->amount);

}
