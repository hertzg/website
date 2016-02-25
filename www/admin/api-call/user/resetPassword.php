<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('user/resetPassword',
    'can_write_users', $apiKey, $mysqli);

include_once 'fns/require_user.php';
$user = require_user($mysqli);

include_once 'fns/require_password_params.php';
require_password_params($user->username, $password);

include_once '../../../fns/Users/resetPassword.php';
Users\resetPassword($mysqli, $user->id_users, $password);

header('Content-Type: application/json');
echo 'true';
