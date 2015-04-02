<?php

namespace Users\Wallets;

function transferAmount ($mysqli, $wallet,
    $toWallet, $amount, $description, $insertApiKey = null) {

    include_once __DIR__.'/Transactions/add.php';
    Transactions\add($mysqli, $wallet, -$amount, $description, $insertApiKey);
    Transactions\add($mysqli, $toWallet, $amount, $description, $insertApiKey);

}
