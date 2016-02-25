<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('invitation/list',
    'can_read_invitations', $apiKey, $mysqli);

include_once '../../../fns/Invitations/index.php';
$invitations = Invitations\index($mysqli);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $invitations));
