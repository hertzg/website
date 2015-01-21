<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_wallets');

include_once 'fns/request_wallet_params.php';
$name = request_wallet_params();

include_once '../../fns/Users/Wallets/add.php';
$id = Users\Wallets\add($mysqli, $user->id_users, $name, $apiKey);

header('Content-Type: application/json');
echo $id;
