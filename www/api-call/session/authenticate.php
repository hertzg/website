<?php

include_once '../../fns/request_strings.php';
list($username, $password, $remember) = request_strings(
    'username', 'password', 'remember');

if ($username === '') {
    include_once '../fns/bad_request.php';
    bad_request('ENTER_USERNAME');
}

if ($password === '') {
    include_once '../fns/bad_request.php';
    bad_request('ENTER_PASSWORD');
}

include_once '../../fns/session_start_custom.php';
session_start_custom();

include_once '../../fns/Session/authenticate.php';
include_once '../../lib/mysqli.php';
$user = Session\authenticate($mysqli, $username, $password, $remember);

if (!$user) {
    include_once '../fns/bad_request.php';
    bad_request('INVALID_USERNAME_OR_PASSWORD');
}

header('Content-Type: application/json');
echo 'true';
