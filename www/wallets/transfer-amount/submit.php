<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer($base);

include_once 'fns/require_wallet_and_multiple_wallets.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet_and_multiple_wallets($mysqli);

include_once "$fnsDir/request_strings.php";
list($to_id) = request_strings('to_id');

$to_id = abs((int)$to_id);

include_once "$fnsDir/Users/Wallets/get.php";
$toWallet = Users\Wallets\get($mysqli, $user, $to_id);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if (!$toWallet || $toWallet->id == $id) redirect("./$itemQuery");

include_once "$fnsDir/WalletTransactions/request.php";
list($amount, $parsed_amount, $description) = WalletTransactions\request();

$errors = [];

if ($amount === '') $errors[] = 'Enter amount.';
elseif ($parsed_amount === 0) $errors[] = 'The amount is invalid.';

if ($errors) {
    $_SESSION['wallets/transfer-amount/errors'] = $errors;
    $_SESSION['wallets/transfer-amount/values'] = [
        'focus' => 'amount',
        'to_id' => $to_id,
        'amount' => $amount,
        'description' => $description,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['wallets/transfer-amount/errors'],
    $_SESSION['wallets/transfer-amount/values']
);

unset($_SESSION['wallets/view/errors']);
$_SESSION['wallets/view/messages'] = ['The amount has been transferred.'];

include_once "$fnsDir/Users/Wallets/transferAmount.php";
Users\Wallets\transferAmount($mysqli,
    $wallet, $toWallet, $parsed_amount, $description);

redirect("../view/$itemQuery");
