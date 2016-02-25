<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('wallet/delete', 'can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once '../../fns/Users/Wallets/delete.php';
Users\Wallets\delete($mysqli, $wallet, $apiKey);

header('Content-Type: application/json');
echo 'true';
