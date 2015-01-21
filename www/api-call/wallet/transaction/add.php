<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_wallets');

include_once '../fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user->id_users);

include_once 'fns/request_transaction_params.php';
list($amount, $description) = request_transaction_params();

include_once '../../../fns/Users/Wallets/Transactions/add.php';
$id = Users\Wallets\Transactions\add($mysqli, $user->id_users,
    $wallet->id, $amount, $description, $apiKey);

header('Content-Type: application/json');
echo $id;
