<?php

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/Theme/Color/getDefault.php';
$theme_color = Theme\Color\getDefault();

$logoSrc = "theme/color/$theme_color/images/zvini.svg";

header('Content-Type: application/json');

include_once '../fns/get_revision.php';
include_once '../fns/SignUpEnabled/get.php';
echo json_encode([
    'logoSrc' => "$logoSrc?".get_revision($logoSrc),
    'sign_up_enabled' => SignUpEnabled\get(),
]);
