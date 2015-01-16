<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_transaction.php';
include_once '../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

include_once "$fnsDir/WalletTransactions/request.php";
list($amount, $parsed_amount, $description) = WalletTransactions\request();

$errors = [];
if ($amount === '') $errors[] = 'Enter amount.';
elseif ($parsed_amount === 0) $errors[] = 'The amount is invalid.';

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/edit-transaction/errors'] = $errors;
    $_SESSION['wallets/edit-transaction/values'] = [
        'amount' => $amount,
        'description' => $description,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['wallets/edit-transaction/errors'],
    $_SESSION['wallets/edit-transaction/values']
);

$_SESSION['wallets/view-transaction/messages'] = ['Changes have been saved.'];

include_once "$fnsDir/Users/Wallets/Transactions/edit.php";
Users\Wallets\Transactions\edit($mysqli,
    $transaction, $parsed_amount, $description);

redirect("../view-transaction/?id=$id");
