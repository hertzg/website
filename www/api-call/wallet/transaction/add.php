<?php

include_once '../../fns/require_api_key.php';
require_api_key('wallet/transaction/add',
    'can_write_wallets', $apiKey, $user, $mysqli);

include_once '../fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once '../fns/require_transaction_params.php';
require_transaction_params($amount, $description);

include_once '../../../fns/Users/Wallets/Transactions/add.php';
$id = Users\Wallets\Transactions\add($mysqli,
    $wallet, $amount, $description, $apiKey);

header('Content-Type: application/json');
echo $id;
