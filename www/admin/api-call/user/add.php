<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('can_write_users', $apiKey, $mysqli);

$fnsDir = '../../../fns';

include_once "$fnsDir/request_strings.php";
list($username, $password, $disabled, $expires) = request_strings(
    'username', 'password', 'disabled', 'expires');

$disabled = (bool)$disabled;
$expires = (bool)$expires;

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
if (Users\getByUsername($mysqli, $username)) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"USERNAME_UNAVAILABLE"');
}

if ($password === '') {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"ENTER_PASSWORD"');
}

include_once "$fnsDir/Password/isShort.php";
if (Password\isShort($password)) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"PASSWORD_TOO_SHORT"');
}

if ($password === $username) {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"PASSWORD_SAME"');
}

include_once "$fnsDir/Users/Account/create.php";
$id = Users\Account\create($mysqli, $username,
    $password, '', $disabled, $expires, $apiKey);

header('Content-Type: application/json');
echo $id;
