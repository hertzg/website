<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

$fnsDir = '../../fns';

include_once "$fnsDir/WalletTransactions/request.php";
list($amount, $parsed_amount, $description) = WalletTransactions\request();

$errors = [];
if ($parsed_amount === 0) $errors[] = 'Enter amount.';

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/new-transaction/errors'] = $errors;
    $_SESSION['wallets/new-transaction/values'] = [
        'amount' => $amount,
        'description' => $description,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['wallets/new-transaction/errors'],
    $_SESSION['wallets/new-transaction/values']
);

include_once "$fnsDir/Users/Wallets/Transactions/add.php";
Users\Wallets\Transactions\add($mysqli,
    $user->id_users, $id, $parsed_amount, $description);

redirect("../view/?id=$id");
