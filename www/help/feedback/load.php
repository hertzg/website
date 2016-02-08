<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$response = [
    'user' => $user === null ? null : [
        'theme_color' => $user->theme_color,
    ],
];

$key = 'help/feedback/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
