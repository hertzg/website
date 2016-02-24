<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireUser.php";
$user = ApiCall\requireUser();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

include_once '../fns/get_values.php';
$response['values'] = get_values();

$key = 'account/close/errors';
if (array_key_exists($key, $_SESSION)) $response['errors'] = $_SESSION[$key];

include_once "$fnsDir/get_absolute_base.php";
$response['absoluteBase'] = get_absolute_base();

header('Content-Type: application/json');
echo json_encode($response);
