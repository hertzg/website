<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/get_values.php';
include_once '../fns/example_password.php';
include_once '../fns/Email/maxLength.php';
include_once '../fns/Password/minLength.php';
include_once '../fns/SignUpEnabled/get.php';
include_once '../fns/Username/maxLength.php';
include_once '../fns/Username/minLength.php';
$response = [
    'values' => get_values(),
    'sign_up_enabled' => SignUpEnabled\get(),
    'usernameMaxLength' => Username\maxLength(),
    'usernameMinLength' => Username\minLength(),
    'passwordMinLength' => Password\minLength(),
    'emailMaxLength' => Email\maxLength(),
    'example_password' => example_password(9),
];

$key = 'sign-up/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
