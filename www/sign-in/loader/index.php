<?php

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

include_once "$fnsDir/SignUpEnabled/get.php";
if (SignUpEnabled\get()) $response['signUpEnabled'] = true;

include_once "$fnsDir/Username/maxLength.php";
$response['usernameMaxLength'] = Username\maxLength();

$key = 'sign-in/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

$key = 'sign-in/messages';
if (array_key_exists($key, $_SESSION)) $response['messages'] = $_SESSION[$key];

include_once "$fnsDir/get_absolute_base.php";
$response['absoluteBase'] = get_absolute_base();

header('Content-Type: application/json');
echo json_encode($response);
