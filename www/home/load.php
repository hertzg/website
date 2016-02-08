<?php

include_once '../fns/ApiCall/requireUser.php';
$user = ApiCall\requireUser();

include_once '../fns/HomePage/unsetSessionVars.php';
HomePage\unsetSessionVars();

header('Content-Type: application/json');
echo json_encode([
    'user' => [
        'theme_color' => $user->theme_color,
    ],
]);
