<?php

$fnsDir = '../../fns';

include_once "$fnsDir/request_strings.php";
list($username, $password, $remember) = request_strings(
    'username', 'password', 'remember');

if ($username === '') {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"ENTER_USERNAME"');
}

if ($password === '') {
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest('"ENTER_PASSWORD"');
}

include_once "$fnsDir/session_start_custom.php";
session_start_custom($new);

include_once "$fnsDir/Session/authenticate.php";
include_once '../../lib/mysqli.php';
$user = Session\authenticate($mysqli,
    $username, $password, $remember, $blocked);

if (!$user) {
    $error = $blocked ? '"USER_BLOCKED"' : '"INVALID_USERNAME_OR_PASSWORD"';
    include_once "$fnsDir/ErrorJson/badRequest.php";
    ErrorJson\badRequest($error);
}

header('Content-Type: application/json');
echo 'true';
