<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_wallets');

include_once 'fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once '../../fns/Users/Wallets/delete.php';
Users\Wallets\delete($mysqli, $wallet, $apiKey);

header('Content-Type: application/json');
echo 'true';
