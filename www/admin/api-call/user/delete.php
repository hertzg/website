<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('user/delete', 'can_write_users', $apiKey, $mysqli);

include_once 'fns/require_user.php';
$user = require_user($mysqli);

include_once '../../../fns/Users/Account/Close/close.php';
Users\Account\Close\close($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
