<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

include_once '../fns/request_transaction_params.php';
$values = request_transaction_params($errors);
list($amount, $parsed_amount, $description) = $values;

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

$_SESSION['wallets/view/messages'] = ['The transaction has been saved.'];

include_once "$fnsDir/Users/Wallets/Transactions/add.php";
Users\Wallets\Transactions\add($mysqli,
    $user->id_users, $id, $parsed_amount, $description);

redirect("../view/?id=$id");