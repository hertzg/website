<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/create_page_load_response.php';
$response = create_page_load_response();

include_once 'fns/get_values.php';
$response['values'] = get_values();

include_once '../fns/SignUpEnabled/get.php';
$response['sign_up_enabled'] = SignUpEnabled\get();

include_once '../fns/Username/maxLength.php';
$response['usernameMaxLength'] = Username\maxLength();

include_once '../fns/Username/minLength.php';
$response['usernameMinLength'] = Username\minLength();

include_once '../fns/Password/minLength.php';
$response['passwordMinLength'] = Password\minLength();

include_once '../fns/Email/maxLength.php';
$response['emailMaxLength'] = Email\maxLength();

include_once '../fns/example_password.php';
$response['example_password'] = example_password(9);

$key = 'sign-up/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
