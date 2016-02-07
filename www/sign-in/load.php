<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

header('Content-Type: application/json');

include_once 'fns/get_values.php';
include_once '../fns/SignUpEnabled/get.php';
echo json_encode([
    'values' => get_values(),
    'sign_up_enabled' => SignUpEnabled\get(),
]);
