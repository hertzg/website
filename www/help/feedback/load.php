<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

//include_once 'fns/unset_session_vars.php';
//unset_session_vars();

if ($user) $theme_color = $user->theme_color;
else {
    include_once '../../fns/Theme/Color/getDefault.php';
    $theme_color = Theme\Color\getDefault();
}

$logoSrc = "theme/color/$theme_color/images/zvini.svg";

header('Content-Type: application/json');

include_once '../../fns/get_revision.php';
echo json_encode([
    'logoSrc' => "$logoSrc?".get_revision($logoSrc),
    'user' => $user !== null,
]);
