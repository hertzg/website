<?php

include_once '../fns/require_api_key.php';
require_api_key('wallet/edit', 'can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once 'fns/require_wallet_params.php';
require_wallet_params($name);

include_once '../../fns/Users/Wallets/edit.php';
Users\Wallets\edit($mysqli, $wallet, $name, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
