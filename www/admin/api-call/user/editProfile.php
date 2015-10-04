<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('can_write_users', $apiKey, $mysqli);

include_once 'fns/require_user.php';
$user = require_user($mysqli);

$fnsDir = '../../../fns';

include_once "$fnsDir/request_strings.php";
list($username) = request_strings('username');

include_once "$fnsDir/str_collapse_spaces.php";
$username = str_collapse_spaces($username);

if ($username === '') {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"ENTER_USERNAME"');
}

include_once "$fnsDir/Username/isValid.php";
if (!Username\isValid($username)) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"INVALID_USERNAME"');
}

include_once "$fnsDir/Users/getByUsername.php";
if (Users\getByUsername($mysqli, $username, $user->id_users)) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"USERNAME_UNAVAILABLE"');
}

include_once "$fnsDir/Users/Account/editProfile.php";
Users\Account\editProfile($mysqli, $user, $username,
    $user->email, $user->full_name, $user->timezone);

include_once "$fnsDir/Password/match.php";
$match = Password\match($user->password_hash, $user->password_salt,
    $user->password_sha512_hash, $user->password_sha512_key, $username);
if ($match) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"USERNAME_SAME"');
}

header('Content-Type: application/json');
echo 'true';
