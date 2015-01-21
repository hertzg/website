<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_wallets');

include_once '../fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user->id_users);

include_once '../../../fns/Users/Wallets/Transactions/deleteAll.php';
Users\Wallets\Transactions\deleteAll($mysqli, $wallet);

header('Content-Type: application/json');
echo 'true';
