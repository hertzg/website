<?php

include_once '../../lib/defaults.php';

$fnsDir = '../fns';

include_once "$fnsDir/request_strings.php";
list($cross_site_api_key) = request_strings('cross_site_api_key');

include_once "$fnsDir/CrossSiteApiKeys/getByKey.php";
include_once '../lib/mysqli.php';
$apiKey = CrossSiteApiKeys\getByKey($mysqli, $cross_site_api_key);

if (!$apiKey) {
    include_once "$fnsDir/ApiCall/Error/forbidden.php";
    ApiCall\Error\forbidden('"INVALID_CROSS_SITE_API_KEY"');
}

include_once "$fnsDir/CrossSiteApiKeys/delete.php";
CrossSiteApiKeys\delete($mysqli, $apiKey->id);

header('Content-Type: application/json');
echo $apiKey->id_users;
