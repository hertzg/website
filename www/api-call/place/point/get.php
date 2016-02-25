<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('place/point/get', 'can_read_places', $apiKey, $user, $mysqli);

include_once 'fns/require_point.php';
$point = require_point($mysqli, $user->id_users);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($point));
