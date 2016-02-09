<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/create_page_load_response.php';
$response = create_page_load_response();

include_once 'fns/get_values.php';
$response['values'] = get_values();

include_once '../fns/Email/maxLength.php';
$response['emailMaxLength'] = Email\maxLength();

$key = 'email-reset-password/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
