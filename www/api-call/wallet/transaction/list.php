<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_wallets');

include_once '../fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user->id_users);

include_once '../../../fns/WalletTransactions/indexOnWallet.php';
$transactions = WalletTransactions\indexOnWallet($mysqli, $wallet->id);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $transactions));
