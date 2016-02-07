<?php

include_once '../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

header('Content-Type: application/json');

include_once '../fns/get_revision.php';
echo json_encode([
    'user' => $user === null ? null : [],
]);
