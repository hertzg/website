<?php

include_once '../../fns/require_api_key.php';
require_api_key('wallet/transaction/deleteAll',
    'can_write_wallets', $apiKey, $user, $mysqli);

include_once '../fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once '../../../fns/Users/Wallets/Transactions/deleteAll.php';
Users\Wallets\Transactions\deleteAll($mysqli, $wallet);

header('Content-Type: application/json');
echo 'true';
