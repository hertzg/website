<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_transaction.php';
include_once '../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

include_once '../fns/request_transaction_params.php';
$values = request_transaction_params($errors);
list($amount, $parsed_amount, $description) = $values;

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['wallets/edit-transaction/errors'] = $errors;
    $_SESSION['wallets/edit-transaction/values'] = [
        'amount' => $amount,
        'description' => $description,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['wallets/edit-transaction/errors'],
    $_SESSION['wallets/edit-transaction/values']
);

include_once "$fnsDir/Wallets/get.php";
$wallet = Wallets\get($mysqli, $transaction->id_wallets);

include_once "$fnsDir/Users/Wallets/Transactions/edit.php";
Users\Wallets\Transactions\edit($mysqli, $wallet,
    $transaction, $parsed_amount, $description);

$_SESSION['wallets/view-transaction/messages'] = ['Changes have been saved.'];

redirect("../view-transaction/$itemQuery");
