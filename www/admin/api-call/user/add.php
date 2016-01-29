<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('can_write_users', $apiKey, $mysqli);

$fnsDir = '../../../fns';

include_once 'fns/require_profile_params.php';
require_profile_params($mysqli, $username, $admin, $disabled, $expires);

include_once 'fns/require_password_params.php';
require_password_params($username, $password);

include_once "$fnsDir/Users/Account/create.php";
$id = Users\Account\create($mysqli, $username,
    $password, '', $admin, $disabled, $expires, $apiKey);

header('Content-Type: application/json');
echo $id;
