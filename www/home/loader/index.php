<?php

include_once '../../fns/ApiCall/requireUser.php';
$user = ApiCall\requireUser();

include_once '../../fns/HomePage/unsetSessionVars.php';
HomePage\unsetSessionVars();

include_once '../../fns/create_page_load_response.php';
$response = create_page_load_response($user);

$key = 'home/messages';
if (array_key_exists($key, $_SESSION)) $response['messages'] = $_SESSION[$key];

header('Content-Type: application/json');
echo json_encode($response);
