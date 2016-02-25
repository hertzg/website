<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('wallet/deleteAll',
    'can_write_wallets', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Wallets/deleteAll.php';
Users\Wallets\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
