<?php

namespace Users\Wallets\Transactions;

function index ($mysqli, $wallet) {

    if (!$wallet->num_transactions) return [];

    include_once __DIR__.'/../../../WalletTransactions/indexOnWallet.php';
    return \WalletTransactions\indexOnWallet($mysqli, $wallet->id);

}
