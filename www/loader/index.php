<?php

include_once '../../lib/defaults.php';

include_once '../fns/ApiCall/requireClientRevision.php';
ApiCall\requireClientRevision();

include_once '../fns/ApiCall/requireGuestUser.php';
ApiCall\requireGuestUser();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/SiteTitle/get.php';
include_once '../fns/Theme/Brightness/getDefault.php';
include_once '../fns/Theme/Color/getDefault.php';
$response = [
    'siteTitle' => SiteTitle\get(),
    'themeBrightness' => Theme\Brightness\getDefault(),
    'themeColor' => Theme\Color\getDefault(),
];

include_once '../fns/SignUpEnabled/get.php';
if (SignUpEnabled\get()) $response['signUpEnabled'] = true;

header('Content-Type: application/json');
echo json_encode($response);
