<?php

include_once '../../fns/require_api_key.php';
require_api_key('wallet/transaction/list',
    'can_read_wallets', $apiKey, $user, $mysqli);

include_once '../fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once '../../../fns/Users/Wallets/Transactions/index.php';
$transactions = Users\Wallets\Transactions\index($mysqli, $wallet);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $transactions));
