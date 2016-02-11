<?php

$fnsDir = '../../fns';

include_once "$fnsDir/Username/request.php";
$username = Username\request();

include_once "$fnsDir/request_strings.php";
list($password, $remember) = request_strings('password', 'remember');

if ($username === '') {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"ENTER_USERNAME"');
}

include_once "$fnsDir/Username/isValid.php";
if (!Username\isValid($username)) {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"INVALID_USERNAME"');
}

if ($password === '') {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"ENTER_PASSWORD"');
}

include_once "$fnsDir/session_start_custom.php";
session_start_custom($new);

include_once "$fnsDir/Session/authenticate.php";
include_once '../../lib/mysqli.php';
$user = Session\authenticate($mysqli,
    $username, $password, $remember, $disabled);

if (!$user) {
    $error = $disabled ? '"USER_DISABLED"' : '"INVALID_USERNAME_OR_PASSWORD"';
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest($error);
}

header('Content-Type: application/json');
echo 'true';
