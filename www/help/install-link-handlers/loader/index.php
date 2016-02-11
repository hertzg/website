<?php

include_once '../../../fns/ApiCall/requireClientRevision.php';
ApiCall\requireClientRevision();

include_once '../../../fns/signed_user.php';
$user = signed_user();

include_once '../../../fns/create_page_load_response.php';
$response = create_page_load_response($user);

include_once '../../../fns/SiteTitle/get.php';
$response['siteTitle'] = SiteTitle\get();

header('Content-Type: application/json');
echo json_encode($response);
