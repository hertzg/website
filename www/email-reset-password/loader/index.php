<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireGuestUser.php";
ApiCall\requireGuestUser();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response();

include_once '../fns/get_values.php';
$response['values'] = get_values();

include_once "$fnsDir/Email/maxLength.php";
$response['emailMaxLength'] = Email\maxLength();

$key = 'email-reset-password/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

include_once "$fnsDir/Captcha/required.php";
if (Captcha\required()) $response['captchaRequired'] = true;

header('Content-Type: application/json');
echo json_encode($response);
