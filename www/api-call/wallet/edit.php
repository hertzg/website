<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_wallet.php';
$wallet = require_wallet($mysqli, $user);

include_once 'fns/request_wallet_params.php';
$name = request_wallet_params($user);

include_once '../../fns/Users/Wallets/edit.php';
Users\Wallets\edit($mysqli, $wallet, $name, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
