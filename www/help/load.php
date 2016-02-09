<?php

include_once '../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/create_page_load_response.php';
$response = create_page_load_response($user);

header('Content-Type: application/json');
echo json_encode($response);
