<?php

include_once '../../fns/require_api_key.php';
require_api_key('wallet/transaction/edit',
    'can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_transaction.php';
$transaction = require_transaction($mysqli, $user->id_users);

include_once '../fns/require_transaction_params.php';
require_transaction_params($amount, $description);

$fnsDir = '../../../fns';

include_once "$fnsDir/Wallets/get.php";
$wallet = Wallets\get($mysqli, $transaction->id_wallets);

include_once "$fnsDir/Users/Wallets/Transactions/edit.php";
Users\Wallets\Transactions\edit($mysqli, $wallet,
    $transaction, $amount, $description, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
