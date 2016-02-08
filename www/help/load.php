<?php

include_once '../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

header('Content-Type: application/json');
echo json_encode([
    'user' => $user === null ? null : [
        'theme_color' => $user->theme_color,
    ],
]);
