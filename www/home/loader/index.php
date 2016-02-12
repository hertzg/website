<?php

$fnsDir = '../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireUser.php";
$user = ApiCall\requireUser();

include_once "$fnsDir/HomePage/unsetSessionVars.php";
HomePage\unsetSessionVars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

$key = 'home/messages';
if (array_key_exists($key, $_SESSION)) $response['messages'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
