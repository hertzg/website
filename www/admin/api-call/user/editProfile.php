<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('user/editProfile', 'can_write_users', $apiKey, $mysqli);

include_once 'fns/require_user.php';
$user = require_user($mysqli);

include_once 'fns/require_profile_params.php';
require_profile_params($mysqli, $username,
    $admin, $disabled, $expires, $user->id_users);

$fnsDir = '../../../fns';

include_once "$fnsDir/Password/match.php";
$match = Password\match($user->password_hash, $user->password_salt,
    $user->password_sha512_hash, $user->password_sha512_key, $username);
if ($match) {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"USERNAME_SAME"');
}

include_once "$fnsDir/Users/Account/editProfile.php";
Users\Account\editProfile($mysqli, $user, $username, $user->email,
    $user->full_name, $user->timezone, $admin, $disabled, $expires, $changed);

header('Content-Type: application/json');
echo 'true';
