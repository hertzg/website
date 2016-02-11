<?php

include_once '../../../fns/ApiCall/requireClientRevision.php';
ApiCall\requireClientRevision();

include_once '../../fns/ApiCall/requireAdminUser.php';
$user = ApiCall\requireAdminUser();

include_once '../../../fns/create_page_load_response.php';
$response = create_page_load_response($user);

header('Content-Type: application/json');
echo json_encode($response);
