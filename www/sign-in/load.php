<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$key = 'sign-in/errors';
if (array_key_exists($key, $_SESSION)) $errors = $_SESSION[$key];
else $errors = null;

header('Content-Type: application/json');

include_once 'fns/get_values.php';
include_once '../fns/SignUpEnabled/get.php';
echo json_encode([
    'errors' => $errors,
    'values' => get_values(),
    'sign_up_enabled' => SignUpEnabled\get(),
]);
