<?php

include_once '../fns/require_api_key.php';
require_api_key('wallet/add', 'can_write_wallets', $apiKey, $user, $mysqli);

include_once 'fns/require_wallet_params.php';
require_wallet_params($name);

include_once '../../fns/Users/Wallets/add.php';
$id = Users\Wallets\add($mysqli, $user->id_users, $name, $apiKey);

header('Content-Type: application/json');
echo $id;
