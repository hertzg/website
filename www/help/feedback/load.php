<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$key = 'help/feedback/errors';
if (array_key_exists($key, $_SESSION)) $errors = $_SESSION[$key];
else $errors = null;

header('Content-Type: application/json');

echo json_encode([
    'errors' => $errors,
    'user' => $user === null ? null : [
        'theme_color' => $user->theme_color,
    ],
]);
