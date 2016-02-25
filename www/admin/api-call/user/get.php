<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('user/get', 'can_read_users', $apiKey, $mysqli);

include_once 'fns/require_user.php';
$user = require_user($mysqli);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($user));
