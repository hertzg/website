<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('user/list', 'can_read_users', $apiKey, $mysqli);

include_once '../../../fns/Users/index.php';
$users = Users\index($mysqli);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $users));
