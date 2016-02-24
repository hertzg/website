<?php

include_once '../../fns/require_api_key.php';
require_api_key('wallet/transaction/get',
    'can_read_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_transaction.php';
$transaction = require_transaction($mysqli, $user->id_users);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($transaction));
