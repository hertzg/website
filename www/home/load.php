<?php

include_once '../fns/ApiCall/requireUser.php';
$user = ApiCall\requireUser();

$logoSrc = "theme/color/$user->theme_color/images/zvini.svg";

header('Content-Type: application/json');

include_once '../fns/get_revision.php';
echo json_encode([
    'logoSrc' => "$logoSrc?".get_revision($logoSrc),
]);
