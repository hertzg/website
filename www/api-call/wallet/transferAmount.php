<?php

include_once '../fns/require_api_key.php';
require_api_key('wallet/transferAmount',
    'can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once 'fns/require_transaction_params.php';
require_transaction_params($amount, $description);

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($to_id) = request_strings('to_id');

$to_id = abs((int)$to_id);

include_once "$fnsDir/Users/Wallets/get.php";
$toWallet = Users\Wallets\get($mysqli, $user, $to_id);

if (!$toWallet) {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"TO_WALLET_NOT_FOUND"');
}

if ($toWallet->id == $wallet->id) {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"TO_WALLET_SAME"');
}

include_once "$fnsDir/Users/Wallets/transferAmount.php";
Users\Wallets\transferAmount($mysqli, $wallet,
    $toWallet, $amount, $description, $apiKey);

header('Content-Type: application/json');
echo 'true';
