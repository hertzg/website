<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

include_once "$fnsDir/SiteTitle/get.php";
$response['siteTitle'] = SiteTitle\get();

header('Content-Type: application/json');
echo json_encode($response);
