<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('wallet/transaction/delete',
    'can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_transaction.php';
$transaction = require_transaction($mysqli, $user->id_users);

include_once '../../../fns/Users/Wallets/Transactions/delete.php';
Users\Wallets\Transactions\delete($mysqli, $transaction);

header('Content-Type: application/json');
echo 'true';
