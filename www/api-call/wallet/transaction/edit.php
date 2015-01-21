<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_wallets');

include_once 'fns/require_transaction.php';
$transaction = require_transaction($mysqli, $user->id_users);

include_once 'fns/request_transaction_params.php';
list($amount, $description) = request_transaction_params($user);

include_once '../../../fns/Users/Wallets/Transactions/edit.php';
Users\Wallets\Transactions\edit($mysqli,
    $transaction, $amount, $description, $apiKey);

header('Content-Type: application/json');
echo 'true';
