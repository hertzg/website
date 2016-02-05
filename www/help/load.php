<?php

include_once '../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/Theme/Color/getDefault.php';
$logoSrc = 'theme/color/'.Theme\Color\getDefault().'/images/zvini.svg';

header('Content-Type: application/json');

include_once '../fns/get_revision.php';
echo json_encode([
    'logoSrc' => "$logoSrc?".get_revision($logoSrc),
    'user' => $user !== null,
]);
