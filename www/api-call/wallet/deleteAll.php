<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_wallets');

include_once '../../fns/Users/Wallets/deleteAll.php';
Users\Wallets\deleteAll($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
