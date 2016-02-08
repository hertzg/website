<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/get_values.php';
include_once '../fns/SignUpEnabled/get.php';
include_once '../fns/Username/maxLength.php';
$response = [
    'values' => get_values(),
    'sign_up_enabled' => SignUpEnabled\get(),
    'usernameMaxLength' => Username\maxLength(),
];

$key = 'sign-in/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

$key = 'sign-in/messages';
if (array_key_exists($key, $_SESSION)) $response['messages'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
