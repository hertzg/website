<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireUser.php";
$user = ApiCall\requireUser();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

include_once '../fns/get_home_items.php';
$homeItems = get_home_items();

include_once '../../fns/get_user_home_items.php';
$response['homeItems'] = get_user_home_items($homeItems, $user);

$key = 'home/customize/reorder/messages';
if (array_key_exists($key, $_SESSION)) $response['messages'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
