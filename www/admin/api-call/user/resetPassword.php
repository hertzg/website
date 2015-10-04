<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('can_write_users', $apiKey, $mysqli);

include_once 'fns/require_user.php';
$user = require_user($mysqli);

$fnsDir = '../../../fns';

include_once "$fnsDir/request_strings.php";
list($password) = request_strings('password');

if ($password === '') {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"ENTER_PASSWORD"');
}

include_once "$fnsDir/Password/isShort.php";
if (Password\isShort($password)) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"PASSWORD_TOO_SHORT"');
}

if ($password === $user->username) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"PASSWORD_SAME"');
}

include_once "$fnsDir/Users/resetPassword.php";
Users\resetPassword($mysqli, $user->id_users, $password);

header('Content-Type: application/json');
echo 'true';
