<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('invitation/deleteAll',
    'can_write_invitations', $apiKey, $mysqli);

include_once '../../../fns/Invitations/deleteAll.php';
Invitations\deleteAll($mysqli);

header('Content-Type: application/json');
echo 'true';
