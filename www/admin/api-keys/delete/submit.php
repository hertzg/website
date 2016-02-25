<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_admin_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id) = require_admin_api_key($mysqli);

include_once "$fnsDir/AdminApiKeys/delete.php";
AdminApiKeys\delete($mysqli, $id);

include_once "$fnsDir/AdminApiKeyAuths/deleteOnAdminApiKey.php";
AdminApiKeyAuths\deleteOnAdminApiKey($mysqli, $id);

unset($_SESSION['admin/api-keys/errors']);
$_SESSION['admin/api-keys/messages'] = [
    "Admin API key #$id has been deleted.",
];

include_once "$fnsDir/redirect.php";
redirect('..');
