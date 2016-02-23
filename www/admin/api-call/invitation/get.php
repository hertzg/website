<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('invitation/get', 
    'can_read_invitations', $apiKey, $mysqli);

include_once 'fns/require_invitation.php';
$invitation = require_invitation($mysqli);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($invitation));
